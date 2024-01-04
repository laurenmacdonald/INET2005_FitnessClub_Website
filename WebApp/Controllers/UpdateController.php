<?php
use Helpers\Validation;
use Models\UpdateModel;

include_once (__DIR__.'/../Controllers/Controller.php');
include_once (__DIR__.'/../Helpers/Validation.php');

/**
 * Controller class to handle logic for updating user information
 */
class UpdateController extends Controller
{
    private Validation $validation;
    private string $userType = "";

    public function __construct($model, $view)
    {
        parent::__construct($model, $view);
        $this->validation = new Validation();

    }

    /**
     * Retrieve information from the update form, check for errors. If no errors, use the Model class to update the
     * record information.
     * @return void
     */
    public function processUpdate(): void
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            // If accessed via any other method than post, redirect
            header("Location: ../index.php");
            exit();
        }
        // Retrieve information from the form
        $firstName = trim($_POST["firstName"] ?? '');
        $lastName = trim($_POST["lastName"] ?? '');
        $email = trim($_POST["email"] ?? '');
        $phone = trim($_POST["phone"] ?? '');
        $address = trim($_POST["address"] ?? '');

        // Assign user type to be used in the query method to query the correct table
        if (isset($_POST["userType"])) {
            $selectedUserType = $_POST["userType"];
            if ($selectedUserType == "member") {
                $this->userType = "member";
            } elseif ($selectedUserType == "trainer") {
                $this->userType = "trainer";
            }
        }

        try {
            // Check for errors using the validateInput method. If returns errors, then set the session variable and redirect.
            $errorUpdateList = $this->validateInput($firstName, $lastName, $email, $phone, $address, $this->userType);
            if (!empty($errorUpdateList)) {
                $_SESSION["errorUpdate"] = $errorUpdateList;
                header("Location: ../Views/pages/updateUser.php");
                exit();
            } else {
                // If no errors, use the UpdateModel class to call the updateUser method to update the record in the table.
                // Set the success variable to 1 and redirect to display success message.
                if($this->model instanceof UpdateModel){
                    $this->model->updateUser($this->connection, $firstName, $lastName, $email, $phone, $address, $this->userType);
                    header("Location: ../Views/pages/updateUser.php?success=1");
                    exit();
                }
            }

        } catch (mysqli_sql_exception $e) {
            die("Error: " . $e->getMessage());
        }
    }

    /**
     * Validate input, if any errors store in an array.
     * @param $firstName
     * @param $lastName
     * @param $email
     * @param $phone
     * @param $address
     * @param $userType
     * @return array
     */
    public function validateInput($firstName, $lastName, $email, $phone, $address, $userType): array
    {
        // Declaring an array variable to hold the errors if they occur to be used later
        $errorUpdate = [];
        // Checking to see if fields are empty
        if ($this->validation->isUpdateInputEmpty($firstName, $lastName, $email, $phone, $address)) {
            $errorUpdate["inputEmpty"] = "Please complete all fields.";
        } else {
            if (!$this->validation->isEmailUsed($this->connection, $email, $userType)) {
                $errorUpdate["emailNotInDB"] = "Email is not in system.";
            }
            if ($this->userType === "") {
                $errorUpdate["userType"] = "Please select member or trainer to update.";
            }
        }

        return $errorUpdate;
    }

    /**
     * Check if session variable holding errors is set - if it is then iterate through the array to display the errors.
     * @return void
     */
    public function updateErrorCheck(): void
    {
        if (isset($_SESSION["errorUpdate"])) {
            $errorUpdateList = $_SESSION["errorUpdate"];
            echo "<br>";
            foreach ($errorUpdateList as $error) {
                echo '<div class="alert alert-warning" role="alert">
            <p>' . $error . '</p></div>';
            }
            unset($_SESSION["errorUpdate"]);
        }
    }

    /**
     * Check to see if the session variable for success is set, display message if it is.
     * @return void
     */
    public function displayUpdateSuccess(): void
    {
        if(isset($_SESSION["updateSuccess"])){
            echo "<br><div class='alert alert-success' role='alert'><p>User updated successfully.</p></div>";
            unset($_SESSION["updateSuccess"]);
        }
    }
}
<?php

use Helpers\Validation;
use Models\RegistrationModel;

include_once (__DIR__.'/../Controllers/Controller.php');
include_once (__DIR__.'/../Helpers/Validation.php');

/**
 * Controller for handling the registration logic
 */
class RegistrationController extends Controller
{
    private Validation $validation;
    private string $userType = "";

    public function __construct($model, $view)
    {
        parent::__construct($model, $view);
        $this->validation = new Validation();
    }

    /**
     *  Handles the user input from the registration form and assigns the user type depending on which user type was
     *  selected. Calls the validateInput function and if no errors found then calls the createUser method
     *  from the RegistrationModel class to create a new record in the applicable table. Sets the success value as 1
     *  to be used to display success message.
     *  If validation errors found, displays these errors.
     * @return void
     */
    public function processRegistration(): void
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            // If accessed via any other method than post, redirect
            header("Location: ../index.php");
            exit();
        }

        // Retrieve the variable information from the form.
        $firstName = trim($_POST["firstName"] ?? '');
        $lastName = trim($_POST["lastName"] ?? '');
        $email = trim($_POST["email"] ?? '');
        $phone = trim($_POST["phone"] ?? '');
        $address = trim($_POST["address"] ?? '');
        $password = trim($_POST["password"] ?? '');

        // Define the userType variable to be used in the query to add the user to the correct table.
        if (isset($_POST["userType"])) {
            $selectedUserType = $_POST["userType"];
            if ($selectedUserType == "member") {
                $this->userType = "member";
            } elseif ($selectedUserType == "trainer") {
                $this->userType = "trainer";
            }elseif ($selectedUserType == "admin") {
                $this->userType = "admin";
            }
        }

        try {
            $errorRegistrationList = $this->validateInput($firstName, $lastName, $email, $phone, $address, $password, $this->userType);
            if (!empty($errorRegistrationList)) {
                $_SESSION["errorRegistration"] = $errorRegistrationList;
                header("Location: ../Views/pages/registration.php");
                exit();
            }
            // If no errors, use RegistrationModel to add the user to the table. Define success as 1 to be used in view
            // to display success message
            if($this->model instanceof RegistrationModel){
                $this->model->createUser($this->connection, $firstName, $lastName, $email, $phone, $address, $password, $this->userType);
                header("Location: ../Views/pages/registration.php?success=1");
                exit();
            }
        } catch (mysqli_sql_exception $e) {
            die("Error: " . $e->getMessage());
        }
    }

    /**
     * Calls methods from the Validation class, if any errors the details are stored in an array.
     * @param $firstName
     * @param $lastName
     * @param $email
     * @param $phone
     * @param $address
     * @param $password
     * @param $userType
     * @return array
     */
    public function validateInput($firstName, $lastName, $email, $phone, $address, $password, $userType): array
    {
        // Declaring an array variable to hold the errors if they occur to be used later
        $errorRegistration = [];
        // Checking to see if fields are empty
        if ($this->validation->isSignUpInputEmpty($firstName, $lastName, $email, $phone, $address, $password)) {
            $errorRegistration["inputEmpty"] = "Please complete all fields.";
        } else {
            if (empty($errorRegistration)) {
                // If no fields empty, run the rest of the input validation
                if ($this->validation->isPasswordInvalid($password)) {
                    $errorRegistration["passwordInvalid"] = "Password must be at least 8 characters and contain one letter and one number";
                }
                if ($this->validation->isEmailInvalid($email)) {
                    $errorRegistration["emailInvalid"] = "Not a valid email.";
                }
                if ($this->validation->isEmailUsed($this->connection, $email, $userType)) {
                    $errorRegistration["emailUsed"] = "Email is already registered in system.";
                }
                if ($this->userType === "") {
                    $errorRegistration["registrationType"] = "Please select member or trainer to register.";
                }
            }
        }
        return $errorRegistration;
    }
    /**
     *  If the session variable holding the list of errors from the validation is set, iterates through list to
     *  display to the user.
     * @return void
     */
    public function registrationErrorCheck(): void
    {
        if (isset($_SESSION["errorRegistration"])) {
            $errorRegistrationList = $_SESSION["errorRegistration"];
            echo "<br>";
            foreach ($errorRegistrationList as $error) {
                echo '<div class="alert alert-warning" role="alert">
            <p>' . $error . '</p></div>';
            }
            unset($_SESSION["errorRegistration"]);
        }
    }
}
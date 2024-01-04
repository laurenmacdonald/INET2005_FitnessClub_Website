<?php

use Helpers\Validation;
use Models\LoginModel;

include_once (__DIR__.'/../Controllers/Controller.php');
include_once (__DIR__.'/../Helpers/Validation.php');
/**
 * Controller for handling login logic
 */
class LoginController extends Controller
{
    private mixed $user;
    private string $userType = "";
    private string $loginPage;
    private Validation $validation;

    public function __construct($model, $view)
    {
        parent::__construct($model, $view);
        $this->validation = new Validation();
    }

    /**
     *  Handles the user input from the login page form and assigns the user type depending on which form was used and
     *  which employee type chosen. Calls the validateInput function and if no errors found then sets the session id.
     * @return void
     */
    public function processLogin(): void
    {
        // Retrieve the variable information from the form
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->loginPage = $_POST['loginPage'] ?? '';
            $email = trim($_POST["email"] ?? '');
            $password = trim($_POST["password"] ?? '');

            // Assign the user type to be used in the query method to ensure the correct table is queried
            if (isset($_POST["userType"])) {
                $selectedUserType = $_POST["userType"];
                if ($selectedUserType === "admin") {
                    $this->userType = "admin";
                } elseif ($selectedUserType === "trainer") {
                    $this->userType = "trainer";
                }
            }
            if ($this->userType !== "admin" && $this->userType !== "trainer") {
                $this->userType = "member";
            }

            try {
                // Check for errors, if there are errors then set the session variable and redirect
                $errorLoginList = $this->validateInput($email, $password);
                if ($errorLoginList) {
                    $_SESSION["errorLogin"] = $errorLoginList;
                    if ($this->loginPage == "employeeLogin") {
                        header("Location: ../Views/pages/employeeLogin.php");
                        die();
                    } elseif ($this->loginPage == "memberLogin") {
                        header("Location: ../Views/pages/memberLogin.php");
                        die();
                    }
                }
                // If no errors on login, create a new session id including the user id to update the session id:
                $newSessionId = session_create_id();
                $sessionId = $newSessionId . "_" . $this->user["id"];
                session_id($sessionId);

                // Setting the session variable userId to match the id of the user from the db
                $_SESSION["userId"] = $this->user["id"] . "_" . $this->userType;
                $_SESSION["name"] = $this->user["firstName"];
                $_SESSION["role"] = $this->userType;

                // Resetting the time for session regeneration so that the counter resets upon log in
                $_SESSION["regeneratedIdTime"] = time();

                // Redirect to the index page once login complete
                header("Location: ../Views/pages/index.php");
                die();
            } catch (mysqli_sql_exception $e) {
                die("Error: " . $e->getMessage());
            }
        }
    }

    /**
     *  Calls methods from the Validation class, if any errors the details are stored in an array.
     * @param $email
     * @param $password
     * @return array
     */
    public function validateInput($email, $password): array
    {
        // Declaring an array to hold errors if they occur
        $errorLoginList = [];
        if($this->validation->isLoginInputEmpty($email, $password)){
            $errorLoginList["inputEmpty"] = "Please complete all fields.";
        } else {
            if ($this->userType === "" && $this->loginPage === "employeeLogin") {
                $errorLoginList["LoginType"] = "Please select admin or trainer to login.";
            } else {
                // If no fields are empty, run the rest of the input validation.
                if($this->validation->isEmailInvalid($email)){
                    $errorLoginList["emailInvalid"] = "Not a valid email.";
                } else {
                    // If fields are not empty and email is valid format,
                    // query db using model class and store the user record in a variable called user
                    if($this->model instanceof LoginModel){
                        $this->user = $this->model->getUserRecord($this->connection, $email, $this->userType);
                        if($this->validation->isLoginEmailWrong($this->user)){
                            $errorLoginList["unregisteredEmail"] = "Unregistered email.";
                        } else {
                            if($this->validation->isPasswordWrong($password, $this->user["passwordHash"])){
                                $errorLoginList["incorrectPassword"] = "Incorrect password.";
                            }
                        }
                    }
                }
            }
        }
        return $errorLoginList;
    }

    /**
     *  If the session variable holding the list of errors from the validation is set, iterates through list to
     *  display to the user.
     * @return void
     */
    public function loginErrorCheck(): void
    {
        if (isset($_SESSION["errorLogin"])) {
            $errorLoginList = $_SESSION["errorLogin"];
            echo "<br>";
            foreach ($errorLoginList as $error) {
                echo '<div class="alert alert-warning" role="alert">
            <p>' . $error . '</p></div>';
            }
            unset($_SESSION["errorLogin"]);
        }
    }
}
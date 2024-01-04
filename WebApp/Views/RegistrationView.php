<?php

namespace Views;
include_once (__DIR__.'/View.php');
/**
 * View for registration
 */
class RegistrationView extends View
{
    /**
     * Echoes HTML for registration form. Checks to see if there are success messages or error messages to display.
     * @param $registrationController
     * @return void
     */
    public function showRegistration($registrationController): void
    {
        echo '
        <body>
<div class="form-div">
    <h3>Registration</h3>';
        if(isset($_GET['success']) && $_GET['success'] == 1){
            echo '<div class="alert alert-success" role="alert">
            <p>Registration successful.</p></div>';
        }
        echo '<form action="../../Helpers/processRegistration.php" name="registration" method="post" id="registration" novalidate>';
        $registrationController->registrationErrorCheck();
        echo'
        <div class="mb-3">
            <label for="firstName" class="form-label">First Name</label>
            <input type="text" class="form-control" id="firstName" name="firstName" required>
        </div>
        <div class="mb-3">
            <label for="lastName" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="lastName" name="lastName" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            User Type:
            <div class="form-check">
                <input class="form-check-input" type="radio" name="userType" value="member" id="member">
                <label class="form-check-label" for="member">
                    Member
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="userType" value="trainer" id="trainer">
                <label class="form-check-label" for="trainer">
                    Trainer
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="userType" value="admin" id="admin">
                <label class="form-check-label" for="admin">
                    Admin
                </label>
            </div>
        </div>

        <button type="submit" class="btn btn-secondary">Submit</button>
        <button type="reset" class="btn btn-secondary">Cancel</button>
    </form>
</div>
</body>
</html>
        ';
    }
}
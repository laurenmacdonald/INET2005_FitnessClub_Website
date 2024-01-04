<?php

namespace Views;
include_once (__DIR__.'/View.php');

/**
 * View for the login page
 */
class LoginView extends View
{
    /**
     * Echoes HTML for employee login. Uses login error check method from the controller to display any errors.
     * @param $loginController
     * @param $formAction
     * @return void
     */
    public function showEmployeeLogin($loginController, $formAction): void
    {
        echo '
            <body>
                <div class="form-div">
                    <h3>Employee Login</h3>
                    <form action="' . $formAction . '" name="login" method="post" id="login" novalidate>';
        $loginController->loginErrorCheck();
        echo
        '<input type="hidden" name="loginPage" value="employeeLogin">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <div id="emailHelp" class="form-text">We will never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            Employee Type:
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="userType" value="admin" id="admin">
                                <label class="form-check-label" for="admin">
                                    Admin
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="userType" value="trainer" id="trainer">
                                <label class="form-check-label" for="trainer">
                                    Trainer
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

    /**
     * Echoes HTML for member login.
     * @param $loginController
     * @param $formAction
     * @return void
     */
    public function showMemberLogin($loginController, $formAction): void{
        echo '
            <body>
                <div class="form-div">
                    <h3>Member Login</h3>
                    <form action="' . $formAction . '" name="login" method="post" id="login" novalidate>
                        ';
        $loginController->loginErrorCheck();
        echo '
                        <input type="hidden" name="loginPage" value="memberLogin">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <div id="emailHelp" class="form-text">We will never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
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
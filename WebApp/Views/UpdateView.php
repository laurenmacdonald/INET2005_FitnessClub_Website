<?php

namespace Views;

include_once (__DIR__.'/View.php');

/**
 * View to display update user form
 */
class UpdateView extends View
{
    /**
     * Echoes HTML to display update form. Checks for any success or error messages and displays them as neccessary.
     * @param $updateController
     * @return void
     */
    public function updateUser($updateController): void
    {
        echo '
        <body>
<div class="form-div">
    <h3>Update User</h3>';
        // Check for success message from URL parameter, displays message if exists.
        if(isset($_GET['success']) && $_GET['success'] == 1){
            echo '<div class="alert alert-success" role="alert">
            Update successful.</div>';
        }
        echo'
    <form action="../../Helpers/processUpdate.php" name="update" method="post" id="update" novalidate>
    ';
        $updateController->updateErrorCheck();
        echo'
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
            <div class="mb-3">
                <label for="email" class="form-label">Email Address of Person to Update:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
          
            <div class="mb-3">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" required>
            </div>
            <div class="mb-3">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="lastName" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
        </div>

        <button type="submit" class="btn btn-secondary">Submit</button>
        <button type="reset" class="btn btn-secondary">Cancel</button>
    </form>
</body>
</html>';
    }
}
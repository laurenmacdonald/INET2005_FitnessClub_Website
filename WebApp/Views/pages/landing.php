<?php
require_once(__DIR__ . '/../../sessionConfig.php');

function displayLanding():void{
    echo'
  <!DOCTYPE html>
<html lang="en">
<div class="container-fluid px-0">
    <div class="row">
        <div class="col-lg-6 vh-100 d-flex align-items-center justify-content-center">
            <div class="position-relative text-center px-5">
                <img class="position-relative" style="object-fit: cover; max-width: 50%; max-height: 50%;" src="../../include/gym_logo.png" alt="gym background">
            </div>
        </div>
        <div class="col-lg-6 vh-100 d-flex align-items-center justify-content-center">
            <div class="px-5">';
                // Check to see if there is an error message and display the error if the user type is incorrect.
                // (Example - if trainer is on signUpSchedule - must be member to see this page)
                if(isset($_GET['error']) && $_GET['error'] == 2) {
        echo '<div class="alert alert-warning" role="alert" style="text-align: center;">
        Invalid user type.</div>';
    }
                echo
                '<h1>Welcome, ' . $_SESSION["name"] .'!</h1> <br>
                ';
                // Check to see what user type and display the appropriate landing information.
                if(isset($_SESSION["role"]) && $_SESSION["role"] === "member"){
                    memberLanding();
                } elseif(isset($_SESSION["role"]) && $_SESSION["role"] === "trainer"){
                    trainerLanding();
                } elseif(isset($_SESSION["role"]) && $_SESSION["role"] === "admin"){
                    adminLanding();
                }
                echo '
            </div>
        </div>
    </div>
</div>
<footer class="py-3 mt-4 absolute">
    <p class="text-center text-muted">Lauren MacDonald W0230178</p>
</footer>
</body>
</html>  
';
}

function memberLanding(): void
{
    echo '  <div class="h-100 text-center">
                    <a class="btn btn-primary btn-lg" href="schedule.php" role="button">Your Schedule</a>
                    <br>
                    <br>
                    <a class="btn btn-primary btn-lg" href="signUpSchedule.php" role="button">Sign Up for Classes</a>
                </div>';
}

function trainerLanding(): void
{
    echo '  <div class="h-100 text-center">
                    <a class="btn btn-primary btn-lg" href="schedule.php" role="button">Your Schedule</a>
                </div>';
}

function adminLanding(): void
{
    echo '  <div class="h-100 text-center">
                    <a class="btn btn-primary btn-lg" href="registration.php" role="button">Register New User</a>
                    <br>
                    <br>
                    <a class="btn btn-primary btn-lg" href="updateUser.php" role="button">Update User Info</a>
                    <br>
                    <br>
                    <a class="btn btn-primary btn-lg" href="schedule.php" role="button">View Schedule</a>
                </div>';
}


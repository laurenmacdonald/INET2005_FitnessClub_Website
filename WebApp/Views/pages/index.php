<?php
include_once "landing.php";
// Check to see if a user is logged in and display the appropriate content.
if(isset($_SESSION["role"])){
    include_once "header.php";
    displayLanding();
} else {
    displayWelcome();
}

function displayWelcome(): void
{
    echo '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fitness Gym</title>
    <link rel="icon" type="image/x-icon" href="../../include/gym_favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bungee Shade">
    <link rel="stylesheet" href="../../include/styles.css">
</head>
    <div class="container-fluid px-0">
    <div class="row">
        <div class="col-lg-6 vh-100 d-flex align-items-center justify-content-center" style="background-color: #463c4b;">
            <div class="px-5">
            ';
    // Check to see if an error is set, will display if admin is not logged in and user is redirected from a page
    //such as registration or updateUser.
    if(isset($_GET['error']) && $_GET['error'] == 1){
        echo '<div class="alert alert-warning" role="alert" style="text-align: center;">
            Error with session, may have timed out. Please log in.</div>';
    }
    echo'
                <h1 class="display-1 text-center" style="color: #FFFFFF">Fitness Club</h1>
                <div class="h-100 text-center">
                    <a class="btn btn-primary btn-lg" href="classes.php" role="button">See Our Classes</a>
                    <a class="btn btn-primary btn-lg" href="trainers.php" role="button">Meet Our Trainers</a>          
                </div>
            </div>
        </div>
        <div class="col-lg-6 vh-100 d-flex align-items-center justify-content-center">
            <div class="position-relative text-center px-5">
                <img class="position-relative" style="object-fit: cover; max-width: 50%; max-height: 50%;" src="../../include/gym_logo.png" alt="gym background">
                   <div class="h-100 text-center">
                    <a class="btn btn-info btn-lg" href="memberLogin.php" role="button">Member Login</a>
                    <a class="btn btn-info btn-lg" href="employeeLogin.php" role="button">Employee Login</a>  
                </div>
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
?>


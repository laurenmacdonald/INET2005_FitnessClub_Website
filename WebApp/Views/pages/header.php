<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fitness Club</title>
    <link rel="icon" type="image/x-icon" href="../../include/gym_favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bungee Shade">
    <link rel="stylesheet" href="../../include/styles.css">
</head>
<body>
<header id="header" class="header is-transparent">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="../../Views/pages/index.php">Fitness Club</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <?php
            // Check which user type is logged in and display the appropriate header.
            if(isset($_SESSION["role"]) && $_SESSION["role"] == "admin"){
                headerAdminDisplay();
            } elseif (isset($_SESSION["role"]) && $_SESSION["role"] == "member"){
                memberHeader();
            } elseif (isset($_SESSION["role"]) && $_SESSION["role"] == "trainer"){
                trainerDisplay();
            } else {
                otherHeader();
            }
            ?>
        </div>
    </nav>
</header>
<?php
function headerAdminDisplay(): void
{
    echo '<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="registration.php">Registration</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="updateUser.php">Update User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="schedule.php">Schedule</a>
                    </li>
                                        <li class="nav-item">
                        <a class="nav-link" href="classes.php">Class Catalogue</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="trainers.php">Our Trainers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../Helpers/logout.php">Logout</a>
                    </li>
                </ul>
            </div>';
}

function trainerDisplay(): void
{
    echo '<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="schedule.php">Schedule</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="classes.php">Class Catalogue</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="trainers.php">Our Trainers</a>
                    </li>
                    <li class="nav-item">
                       <a class="nav-link" href="../../Helpers/logout.php">Logout</a>
                    </li>
                </ul>
            </div>';
}

function memberHeader(): void {
    echo '<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="signUpSchedule.php">Sign Up For Classes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="schedule.php">View Your Schedule</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="classes.php">Class Catalogue</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="trainers.php">Our Trainers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../Helpers/logout.php">Logout</a>
                    </li>
                </ul>
            </div>';
}
function otherHeader(): void {
    echo '<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
               
                    <li class="nav-item">
                         
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="classes.php">Class Catalogue</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="trainers.php">Our Trainers</a>
                    </li>
                </ul>
                <span class>
                    <a class="btn btn-secondary btn-md" href="employeeLogin.php" role="button">Employee Login</a> 
                    <a class="btn btn-secondary btn-md" href="memberLogin.php" role="button">Member Login</a>
                </span>
            </div>';
}
?>


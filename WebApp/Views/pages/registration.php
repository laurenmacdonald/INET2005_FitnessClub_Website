<?php

use Models\RegistrationModel;
use Views\RegistrationView;

/**
 * Page to display registration form
 */
require_once(__DIR__ . '/../../sessionConfig.php');
// If there is no user logged in, redirect and assign URL param error as 1
if (!isset($_SESSION["userId"])) {
    header("Location: ../pages/index.php?error=1");
    exit();
} else
    // If a user is logged in but they are not of the admin role, redirect and assign URL param error as 2
    if ($_SESSION["role"] != "admin") {
        header("Location: ../pages/index.php?error=2");
        exit();
    } else {
        // If admin is logged in, instantiate view, model and controller for registration and call the showRegistration
        // method from the registrationView.
        include_once(__DIR__ . '/../RegistrationView.php');
        include_once(__DIR__ . '/../../Models/RegistrationModel.php');
        include_once(__DIR__ . '/../../Controllers/RegistrationController.php');
        include_once "header.php";
        $registrationView = new RegistrationView();
        $registrationModel = new RegistrationModel();
        $registrationController = new RegistrationController($registrationModel, $registrationView);
        $registrationView->showRegistration($registrationController);
    }

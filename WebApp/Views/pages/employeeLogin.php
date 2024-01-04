<?php

use Models\LoginModel;
use Views\LoginView;

/**
 * page to display employee login
 */
include_once "header.php";
include_once (__DIR__.'/../LoginView.php');
include_once (__DIR__.'/../../Models/LoginModel.php');
include_once (__DIR__.'/../../Controllers/LoginController.php');
// Form action to redirect to process login helper
$formAction = "../../Helpers/processLogin.php";
// Instantiate new login, model and controller, use showEmployeeLogin from the view class, taking controller and form action as params.
$loginView = new LoginView();
$loginModel = new LoginModel();
$loginController = new LoginController($loginModel, $loginView);
$loginView->showEmployeeLogin($loginController, $formAction);


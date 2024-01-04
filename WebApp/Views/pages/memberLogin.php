<?php

use Models\LoginModel;
use Views\LoginView;

/**
 * Page to display member login form
 */
include_once(__DIR__ . '/../LoginView.php');
include_once(__DIR__ . '/../../Models/LoginModel.php');
include_once(__DIR__ . '/../../Controllers/LoginController.php');
include_once "header.php";
// Form action to process login appropriately
$formAction = "../../Helpers/processLogin.php";
// Instantiate view, model controller. showMemberLogin function from the view is called, taking controller and
// form action as params.
$loginView = new LoginView();
$loginModel = new LoginModel();
$loginController = new LoginController($loginModel, $loginView);
$loginView->showMemberLogin($loginController, $formAction);




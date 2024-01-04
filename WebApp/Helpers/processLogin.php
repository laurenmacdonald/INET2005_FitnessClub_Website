<?php

use Models\LoginModel;
use Views\LoginView;

include_once (__DIR__.'/../Views/LoginView.php');
include_once (__DIR__.'/../Models/LoginModel.php');
include_once (__DIR__.'/../Controllers/LoginController.php');

// Instantiate new model and view objects, use them as parameters in the controller object and call the processLogin function
$loginModel = new LoginModel();
$loginView = new LoginView();
$loginController = new LoginController($loginModel, $loginView);
$loginController->processLogin();

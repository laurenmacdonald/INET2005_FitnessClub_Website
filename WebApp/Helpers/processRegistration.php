<?php
use Models\RegistrationModel;
use Views\RegistrationView;

include_once (__DIR__.'/../Views/RegistrationView.php');
include_once (__DIR__.'/../Models/RegistrationModel.php');
include_once (__DIR__.'/../Controllers/RegistrationController.php');
// Instantiate new model and view objects to be used as parameters in the controller object. Call the processRegistration method.
$registrationModel = new RegistrationModel();
$registrationView = new RegistrationView();
$registrationController = new RegistrationController($registrationModel, $registrationView);
$registrationController->processRegistration();
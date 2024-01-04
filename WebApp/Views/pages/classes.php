<?php
use Controllers\DisplayController;
use Models\DisplayModel;
use Views\DisplayView;

/**
 * Page to display all class information on website. Uses view, model, controller.
 */
require_once(__DIR__ . '/../../sessionConfig.php');
include_once(__DIR__ . '/../DisplayView.php');
include_once(__DIR__ . '/../../Models/DisplayModel.php');
include_once(__DIR__ . '/../../Controllers/DisplayController.php');
include_once "header.php";

// Instantiate view and model to be used in controller. Call the displayClasses function to display classes.
$displayView = new DisplayView();
$displayModel = new DisplayModel();
$displayController = new DisplayController($displayModel, $displayView);
$displayController->displayClasses();

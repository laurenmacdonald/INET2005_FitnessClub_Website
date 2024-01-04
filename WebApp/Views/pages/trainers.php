<?php

use Controllers\DisplayController;
use Models\DisplayModel;
use Views\DisplayView;

require_once(__DIR__ . '/../../sessionConfig.php');
    include_once(__DIR__ . '/../DisplayView.php');
    include_once(__DIR__ . '/../../Models/DisplayModel.php');
    include_once(__DIR__ . '/../../Controllers/DisplayController.php');
    include_once "header.php";

    // Instantiate new view, model and controllers to call displayTrainers() method
    $displayView = new DisplayView();
    $displayModel = new DisplayModel();
    $displayController = new DisplayController($displayModel, $displayView);
    $displayController->displayTrainers();


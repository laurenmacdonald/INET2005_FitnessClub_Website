<?php

use Models\UpdateModel;
use Views\UpdateView;
require_once(__DIR__ . '/../../sessionConfig.php');
// Check to see if a user is logged in. If not, redirect and set URL param as error = 1
if (!isset($_SESSION["userId"])) {
    header("Location: ../pages/index.php?error=1");
    exit();
} else
    // If the user is logged in but not admin, redirect and set URL param as error = 2
    if ($_SESSION["role"] != "admin") {
    header("Location: ../pages/index.php?error=2");
    exit();
} else {
    include_once(__DIR__ . '/../UpdateView.php');
    include_once(__DIR__ . '/../../Models/UpdateModel.php');
    include_once(__DIR__ . '/../../Controllers/UpdateController.php');
    include_once "header.php";

    // If admin logged in, instantiate model, view, controller and call the updateUser method from the view.
    $updateModel = new UpdateModel();
    $updateView = new UpdateView();
    $updateController = new UpdateController($updateModel, $updateView);
    $updateView->updateUser($updateController);
}

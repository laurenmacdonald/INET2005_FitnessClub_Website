<?php

use Models\UpdateModel;
use Views\UpdateView;

include_once (__DIR__.'/../Views/UpdateView.php');
include_once (__DIR__.'/../Models/UpdateModel.php');
include_once (__DIR__.'/../Controllers/UpdateController.php');
// Instantiate new model and view objects to be used in the controller parameters. Call the processUpdate method.
$updateModel = new UpdateModel();
$updateView = new UpdateView();
$updateController = new UpdateController($updateModel, $updateView);
$updateController->processUpdate();

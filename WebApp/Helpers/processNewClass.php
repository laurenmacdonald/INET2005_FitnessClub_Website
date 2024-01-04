<?php

use Models\ScheduleModel;
use Views\ScheduleView;

include_once (__DIR__.'/../Views/ScheduleView.php');
include_once (__DIR__.'/../Models/ScheduleModel.php');
include_once (__DIR__.'/../Controllers/ScheduleController.php');

// Instantiate new view and model objects, use them as parameters in controller object.
$scheduleView = new ScheduleView();
$scheduleModel = new ScheduleModel();
$scheduleController = new ScheduleController($scheduleModel, $scheduleView);
// Check to see if the admin role session variable is assigned. If not, redirect to the index page and set the URL
// parameter as error=1 to display error message on that page.
if(!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin"){
    header("Location: ../Views/pages/index.php?error=1");
}
// If admin role is set then add the new class.
$scheduleController->addNewClass();
// redirect to the schedule page.
header("../Views/pages/schedule.php");

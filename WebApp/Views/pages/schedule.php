<?php

use Models\ScheduleModel;
use Views\ScheduleView;


?>

<body>
<div class="card-body">
    <?php
    require_once(__DIR__ . '/../../sessionConfig.php');
    // Check to see if the role is assigned. If not redirect to the index with the URL param as error=1
    if (!isset($_SESSION["role"])) {
        header("Location: ../pages/index.php?error=1");
        exit();
    } else
    {
        include_once(__DIR__ . '/../ScheduleView.php');
        include_once(__DIR__ . '/../../Models/ScheduleModel.php');
        include_once(__DIR__ . '/../../Controllers/ScheduleController.php');
        include_once "header.php";
        // If the user is logged in, instantiate view, model and controller and call processRequest from the controller.
        $scheduleView = new ScheduleView();
        $scheduleModel = new ScheduleModel();
        $scheduleController = new ScheduleController($scheduleModel, $scheduleView);
        $scheduleController->processRequest();
    }


    ?>
</div>
</body>
</html>

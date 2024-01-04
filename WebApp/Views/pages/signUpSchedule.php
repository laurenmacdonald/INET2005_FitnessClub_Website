<?php

require_once(__DIR__ . '/../../sessionConfig.php');
use Models\ScheduleModel;
// Check to see if a user is logged in and if not redirect and set URL param as error=1
if (!isset($_SESSION["role"])) {
    header("Location: ../pages/index.php?error=1");
    exit();
} else {
    include_once(__DIR__ . '/../../Models/ScheduleModel.php');
    include_once(__DIR__ . '/../../dbConfig.php');
    include_once "header.php";

    // If logged in, call db configuration, schedule model to get the openings available for classes.
    $dbConfig = new dbConfig();
    $connection = $dbConfig->getConnection();
    $scheduleModel = new ScheduleModel();
    $bookingData = $scheduleModel->getOpenings($connection);

    // If no open classes, display error message, else show available classes.
    if ($bookingData == null) {
        echo "<div class='container'>
                  <h3>Sign Up For Classes</h3>
                  <p>No open classes. Contact admin.</p></div>";
    } else {
        echo '
            <div class="container">
                <h3>Sign Up For Classes</h3>
                <div class="table-responsive-sm">
                    <table class="table table-sm table-striped table-bordered">
                        <tr>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Class</th>
                            <th>Trainer</th>
                            <th>Book</th>
                        </tr>';

        foreach ($bookingData as $class) {
            echo '<tr>';
            echo '<td>' . $class["Date"] . '</td>';
            echo '<td>' . $class["Time"] . '</td>';
            echo '<td>' . $class["Class"] . '</td>';
            echo '<td>' . $class["Trainer"] . '</td>';
            if ($class["memberId"] == 0) {
                // Set the class id URL parameter as the class id of the record to be used in the bookClass function.
                echo '<td><a class="btn btn-secondary btn-sm" href="../../Models/functions/bookClass.php?id=' . $class['id'] . '"role="button">Book</a></td>';
            } else {
                echo '<td>You are booked!</td>';
            }
            echo '</tr>';
        }
        echo '</table></div>';
    }
}
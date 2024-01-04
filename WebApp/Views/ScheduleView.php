<?php

namespace Views;
include_once(__DIR__ . '/View.php');

/**
 * View for schedule page.
 */
class ScheduleView extends View
{
    /**
     * Echoes HTML for admin schedule information. Checks to see if the data for the schedule exits and displays message
     * if the variable is empty. Checks for any success messages or error messages where applicable. Calls the addClass method
     * to display that functionality. Iterates through the list of schedule data to display in a table.
     * @param $scheduleData
     * @param $trainerList
     * @param $classList
     * @return void
     */
    public function showSchedForAdmin($scheduleData, $trainerList, $classList): void
    {
        if ($scheduleData == null) {
            echo "<div class='container'>
                  <div class='alert alert-info' role='alert'>Nothing scheduled. Add more classes.</div></div>";
        }
        echo "<div class='container'>
                  <h3>Class Schedule</h3>";
        if (isset($_GET['success']) && $_GET['success'] == 1) {
            echo '<div class="alert alert-success" role="alert">
            Delete successful.</div>';
        }
        if (isset($_GET['successAdd']) && $_GET['successAdd'] == 1) {
            echo '<div class="alert alert-success" role="alert">
        Class added successfully.</div>';
        }
        if (isset($_GET['successAdd']) && $_GET['successAdd'] == 0) {
            echo '<div class="alert alert-warning" role="alert">
        Please complete all fields.</div>';
        }
        $this->addClass($trainerList, $classList);
        echo "<div class='container-fluid'><div class='table-responsive-sm'><table class='table table-striped table-bordered'>";
        echo "<tr>
            <th>Date</th>
            <th>Time</th>
            <th>Class</th>
            <th>Trainer</th>
            <th>Member</th>
            <th>Edit Schedule</th>
          </tr>";
        // Iterate through schedule data to display as a table.
        foreach ($scheduleData as $row) {
            echo "<tr>";
            echo "<td>" . $row['Date'] . "</td>";
            echo "<td>" . $row['Time'] . "</td>";
            echo "<td>" . $row['Class'] . "</td>";
            echo "<td>" . $row['Trainer'] . "</td>";
            echo "<td>" . $row['Member'] . "</td>";
            // Sets the URL parameter as the id associated with the record to be retrieved when delete clicked.
            echo "<td><a href='../../Models/functions/deleteClass.php?id=" . $row['id'] . "'>Delete</a>";
            echo "</tr>";
        }
        echo "</table></div></div>";
        echo '
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>';
    }

    /**
     * Echoes HTML for member. Checks to see if schedule data holds any values, if not provide message and link to sign up.
     * Else displays member's schedule information in table by iterating through schedule data array.
     * @param $scheduleData
     * @return void
     */
    public
    function showMemberSchedule($scheduleData): void
    {
        if ($scheduleData == null) {
            echo "<div class='container'>
                  <div class='alert alert-info' role='alert'>Nothing in your schedule, <a href='signUpSchedule.php'>sign up!</a></div></div>";
        } else {
            echo "<div class='container'>
                  <h3>Your Schedule</h3>";
            echo "
                <div class='container-fluid'>
                <div class='table-responsive-sm'>
                <table class='table table-sm table-striped table-bordered'>";
            echo "<tr>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Class</th>
                                <th>Trainer</th>
                              </tr>";

            // Iterate through schedule data array and display in table
            foreach ($scheduleData as $class) {
                echo "<tr>";
                echo "<td>" . $class['Date'] . "</td>";
                echo "<td>" . $class['Time'] . "</td>";
                echo "<td>" . $class['Class'] . "</td>";
                echo "<td>" . $class['Trainer'] . "</td>";
                echo "</tr>";
            }
            echo "</table></div></div>";
            echo '
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>';
        }
    }

    /**
     * Echoes HTML to display trainer's schedule. If schedule data null, display message. Else show schedule.
     * @param $scheduleData
     * @return void
     */
    public
    function showSchedForTrainer($scheduleData): void
    {
        if ($scheduleData == null) {
            echo "<div class='container'>
                  <div class='alert alert-info' role='alert'>Nothing scheduled. Contact your admin to be added to the schedule.</div></div>";
        } else {
            echo "<div class='container'>
                  <h3>Trainer Schedule</h3>";
            echo "<div class='container-fluid'><div class='table-responsive-sm'><table class='table table-striped table-bordered'>";
            echo "<tr>
                <th>Date</th>
                <th>Time</th>
                <th>Class</th>
                <th>Member</th>
                <th>Member Attended?</th>
              </tr>";
            // Iterate through schedule data to display data in a table.
            foreach ($scheduleData as $class) {
                echo "<tr>";
                echo "<td>" . $class['Date'] . "</td>";
                echo "<td>" . $class['Time'] . "</td>";
                echo "<td>" . $class['Class'] . "</td>";
                echo "<td>" . $class['Member'] . "</td>";
                // Check to see attendance status, if absent then display option to mark member as attended.
                if ($class['AttendanceStatus'] == "Absent") {
                    // Set URL parameter to id associated with record to be used in the markAttended function
                    echo "<td><a href='../../Models/functions/markAttended.php?id=" . $class['id'] . "'>Mark Attended</a></td>";
                } else {
                    echo "<td>" . $class['AttendanceStatus'] . "</td>";
                }
                echo "</tr>";
            }
            echo "</table> </div></div>";
        }
    }

    /**
     * Echoes HTML to add a class. Uses Javascript to collapse and un-collapse form by button click.
     * @param $trainerList
     * @param $classList
     * @return void
     */
    public
    function addClass($trainerList, $classList): void
    {
        echo '<p class="d-inline-flex gap-1">
                <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Add More Classes
                </button>
            <div class="collapse" id="collapseExample">
                <div class="card card-body">
                    <div class="form-div">
                        <h3>Add a Class</h3>
                        <form action="../../Helpers/processNewClass.php" name="addClass" method="post" id="addClass" novalidate>
                            <div class="mb-3">
                                <label for="date" class="form-label">Date</label>
                                <input type="date" class="form-control" id="date" name="date" required>
                            </div>
                            <div class="mb-3">
                                <label for="startTime" class="form-label">Start Time</label>
                                <input type="time" class="form-control" id="startTime" name="startTime" required>
                            </div>
                            <div class="mb-3">
                                <label for="endTime" class="form-label">End Time</label>
                                <input type="time" class="form-control" id="endTime" name="endTime" required>
                            </div>
                            <div class="mb-3">
                                Trainer';
        // Iterate through class list to display as radio button options.
        foreach ($classList as $class) {
            echo '<div class="form-check">
                     <input class="form-check-input" type="radio" name="class" value="' . $class['id'] . '" id="' . $class['id'] . '">
                        <label class="form-check-label" for="' . $class['id'] . '">
                         ' . $class['className'] . '
                         </label>
                   </div>';
        }

        echo '</div>
              <div class="mb-3">
                 Trainer';
        // Iterate through trainer list to display as radio button options
        foreach ($trainerList as $trainer) {
            echo '<div class="form-check">
                      <input class="form-check-input" type="radio" name="trainer" value="' . $trainer['id'] . '" id="' . $trainer['id'] . '">
                            <label class="form-check-label" for="' . $trainer['id'] . '">
                                 ' . $trainer['TrainerName'] . '
                            </label>
                  </div>';
        }

        echo '</div>
               <button type="submit" class="btn btn-secondary">Add Class</button>
                        </form>
                    </div>
                </div>
            </div>
            </p>';
    }
}

<?php

use Helpers\Validation;
use Models\ScheduleModel;
use Views\ScheduleView;

include_once(__DIR__ . '/../Controllers/Controller.php');
include_once (__DIR__.'/../Helpers/Validation.php');
/**
 * Controller for handling the schedule logic
 */
class ScheduleController extends Controller
{
    private Validation $validation;
    public function __construct($model, $view)
    {
        parent::__construct($model, $view);
        $this->validation = new Validation();
    }

    /**
     * Check to see what view and model were provided to the constructor, calls methods from those classes to
     * get data from the database (model) and apply the appropriate view.
     * @return void
     */
    public function processRequest(): void
    {
        // if the view and model provided to the constructor are of Schedule, then use the methods from those classes.
        if ($this->view instanceof ScheduleView) {
            if ($this->model instanceof ScheduleModel) {
                // Get the list of classes and trainers to be used in adding a new class.
                $trainerList = $this->model->getTrainerList($this->connection);
                $classList = $this->model->getClassList($this->connection);
                // Depending on session variable for user role, displays the appropriate schedule information.
                if ($_SESSION["role"] === "member") {
                    $scheduleData = $this->model->getMemberSchedule($this->connection);
                    $this->view->showMemberSchedule($scheduleData);
                } elseif ($_SESSION["role"] === "trainer") {
                    $scheduleData = $this->model->getTrainerSchedule($this->connection);
                    $this->view->showSchedForTrainer($scheduleData);
                } elseif ($_SESSION["role"] === "admin") {
                    $scheduleData = $this->model->getScheduleRecord($this->connection);
                    $this->view->showSchedForAdmin($scheduleData, $trainerList, $classList);
                } else {
                    header("Location: ../Views/pages/index.php?error=1");
                }
            }
        }
    }

    /**
     * Gets information from the add a new class form, checks for input errors and if none, calls the addClass method
     * from the ScheduleModel to add the class to the database. If there are errors display the errors, if successful
     * display success message.
     * @return void
     */
    public function addNewClass(): void
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: ../Views/pages/index.php?error=1");
            exit();
        }

        // Retrieve the variable information from the form.
        $date = trim($_POST["date"] ?? '');
        $startTime = $_POST["startTime"];
        $endTime = $_POST["endTime"];
        $classId = $_POST["class"];
        $trainerId = $_POST["trainer"];

        try {
            // Check for errors, if there are any define successAdd as 0 to be used to display error message in the view
            $errorAddList = $this->validateInput($date, $startTime, $endTime, $classId, $trainerId);
            if(!empty($errorAddList)){
                $_SESSION["errorAddClass"] = $errorAddList;
                header("Location: ../Views/pages/schedule.php?successAdd=0");
                exit();
            }
            // If no errors, then use the ScheduleModel to add the class to the table in the database, define successAdd
            // as 1 to display success message in the view.
            if ($this->model instanceof ScheduleModel) {
                $this->model->addClass($this->connection, $date, $startTime, $endTime, $classId, $trainerId);
                header("Location: ../Views/pages/schedule.php?successAdd=1");
            }
        } catch (mysqli_sql_exception $e) {
            die("Error: " . $e->getMessage());
        }
    }

    /**
     * Check for input errors using the Validation class, if method returns true then store the details in the
     * error array to be displayed to the user.
     * @param $date
     * @param $startTime
     * @param $endTime
     * @param $classId
     * @param $trainerId
     * @return array
     */
    public function validateInput($date, $startTime, $endTime, $classId, $trainerId): array
    {
        // declaring array variable to hold errors if they occur
        $errorAdd = [];
        // Checking if fields are empty.
        if($this->validation->isAddClassInputEmpty($date, $startTime, $endTime, $classId, $trainerId)){
            $errorAdd["inputEmpty"] = "Please complete all fields.";
        }
        return $errorAdd;
    }
}
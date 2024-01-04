<?php

namespace Controllers;
use Controller;
use Models\DisplayModel;
use Views\DisplayView;

include_once(__DIR__ . '/../Controllers/Controller.php');

/**
 * Controller for displaying information about trainers and classes offered by the gym
 */
class DisplayController extends Controller
{
    public function __construct($model, $view)
    {
        parent::__construct($model, $view);
    }

    /**
     * @return void
     * Gets the list of all trainers from the DB and feeds it to the DisplayView
     */
    public function displayTrainers(): void
    {
        if ($this->view instanceof DisplayView) {
            if ($this->model instanceof DisplayModel) {
                $trainerList = $this->model->getAllTrainers($this->connection);
                $this->view->showAllTrainers($trainerList);
            }
        }
    }
    /**
     * @return void
     * Gets the list of all classes from the DB and feeds it to the DisplayView
     */
    public function displayClasses(): void
    {
        if ($this->view instanceof DisplayView) {
            if ($this->model instanceof DisplayModel) {
                $classList = $this->model->getAllClasses($this->connection);
                $this->view->showAllClasses($classList);
            }
        }
    }
}
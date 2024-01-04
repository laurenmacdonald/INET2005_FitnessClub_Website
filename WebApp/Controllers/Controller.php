<?php

use Models\Model;
use Views\View;

include_once(__DIR__ . '/../dbConfig.php');

/**
 * Abstract class Controller which holds dbConfig, mysqli, Model and View attributes to be extended to Controller subclasses.
 */
abstract class Controller
{
    protected dbConfig $dbConfig;
    protected mysqli $connection;
    protected Model $model;
    protected View $view;

    /**
     * @param $model Model
     * @param $view View
     */
    public function __construct(Model $model, View $view)
    {
        $this->dbConfig = new dbConfig();
        $this->connection = $this->dbConfig->getConnection();
        $this->model = $model;
        $this->view = $view;
    }

}
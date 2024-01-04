<?php

namespace Models;
include_once (__DIR__.'/Model.php');

/**
 * Model for displaying trainer information and class information.
 */
class DisplayModel extends Model
{
    /**
     * Query database for trainer information, return associative array
     * @param $mysqli
     * @return null
     */
    function getAllTrainers($mysqli){
        $sql = "SELECT id, CONCAT(firstName, ' ', lastName) AS TrainerName, description, imgPath 
        FROM trainer;";
        $result = $mysqli->query($sql);
        if ($result === false) {
            return null;
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Query database for class information, return associative array
     * @param $mysqli
     * @return null
     */
    function getAllClasses($mysqli){
        $sql = "SELECT id, className, classDescription, classImgPath
        FROM classtemplate;";
        $result = $mysqli->query($sql);
        if ($result === false) {
            return null;
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
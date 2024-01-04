<?php

namespace Models;
include_once (__DIR__.'/Model.php');
class LoginModel extends Model
{
    /**
     * Query database for email and return an associative array of user data corresponding to the email.
     * @param $mysqli
     * @param $email
     * @param $userType
     * @return mixed
     */
    function getUserRecord($mysqli, $email, $userType){
        $sql = sprintf("SELECT * FROM ".$userType." WHERE email = '%s'", $mysqli -> real_escape_string($email));
        $result = $mysqli->query($sql);
        return $result->fetch_assoc();
    }
}
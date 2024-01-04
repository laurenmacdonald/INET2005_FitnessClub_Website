<?php

namespace Models;
include_once (__DIR__.'/Model.php');
class RegistrationModel extends Model
{
    /**
     * Take information to create a new user, using INSERT statement to add record to table.
     * @param $mysqli
     * @param $firstName
     * @param $lastName
     * @param $email
     * @param $phone
     * @param $address
     * @param $password
     * @param $userType
     * @return void
     */
    function createUser($mysqli, $firstName, $lastName, $email, $phone, $address, $password, $userType): void
    {
        $sql = "INSERT INTO ".$userType."(firstName, lastName, email, phone, address, passwordHash) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);

        // Hash the password using the PASSWORD_DEFAULT algorithm
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param('ssssss', $firstName, $lastName, $email, $phone, $address, $passwordHash);
        $stmt->execute();
    }

    /**
     * Get the email from the database, if it is not there will return false, else true.
     * @param $mysqli
     * @param $email
     * @param $userType
     * @return mixed
     */
    function getEmail($mysqli, $email, $userType){
        $sql = "SELECT email FROM ".$userType." WHERE email = ?";

        // Using prepared statements to send in query separately from user input data to prevent SQL injection.
        $stmt = $mysqli->prepare($sql);
        // Using the bind parameter method to replace the string placeholder in the above query
        $stmt->bind_param('s', $email);
        $stmt->execute();

        // Grabbing the result from the database. If there is an email that matches, will return true.
        return $stmt->fetch();
    }
}
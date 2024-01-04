<?php

namespace Helpers;


use Models\RegistrationModel;
include_once (__DIR__.'/../Models/RegistrationModel.php');

/**
 * Class to validate any user input from forms submit.
 */
class Validation
{
    /**
     * Check to see if the variables are empty. Return true if empty, false if not empty.
     * @param $firstName
     * @param $lastName
     * @param $email
     * @param $phone
     * @param $address
     * @param $password
     * @return bool
     */
    function isSignUpInputEmpty($firstName, $lastName, $email, $phone, $address, $password): bool
    {
        // If any of the fields are empty, return bool true.
        if (empty($firstName) || empty($lastName) || empty($email) || empty($phone) || empty($address) || empty($password)){
            return true;
        } else {
            return false;
        }
    }

    /**
     * Check to see if the variables are empty. Return true if empty, false if not empty.
     * @param $email
     * @param $password
     * @return bool
     */
    function isLoginInputEmpty($email, $password): bool
    {
        // If any of the fields are empty, return bool true.
        if (empty($email) || empty($password)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Check to see if the variables are empty. Return true if empty, false if not empty.
     * @param $firstName
     * @param $lastName
     * @param $email
     * @param $phone
     * @param $address
     * @return bool
     */
    function isUpdateInputEmpty($firstName, $lastName, $email, $phone, $address): bool
    {
        // If any of the fields are empty, return bool true.
        if (empty($firstName) || empty($lastName) || empty($email) || empty($phone) ||  empty($address)){
            return true;
        } else {
            return false;
        }
    }

    /**
     * Check to see if the variables are empty. Return true if empty, false if not empty.
     * @param $date
     * @param $startTime
     * @param $endTime
     * @param $classId
     * @param $trainerId
     * @return bool
     */
    function isAddClassInputEmpty($date, $startTime, $endTime, $classId, $trainerId): bool
    {
        // If any fields empty, return true.
        if(empty($date) || empty($startTime) || empty($endTime) || empty($classId) || empty($trainerId)){
            return true;
        } else {
            return false;
        }
    }

    /**
     * Check to see if password meets requirements. Returns true if it does, false if it doesn't.
     * @param $password
     * @return bool
     */
    function isPasswordInvalid($password): bool
    {
        // If password doesn't meet requirements, return true
        if (strlen($password) < 8 || !preg_match("/[a-z]/i", $password) || !preg_match("/[0-9]/i", $password)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Checks to see if email is invalid, if it is then return true, else return false.
     * @param $email
     * @return bool
     */
    function isEmailInvalid($email): bool
    {
        // Using the php method to check if email is valid email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Check to see if the email is already in the table, returns true if it is, false if it is not.
     * @param $mysqli
     * @param $email
     * @param $userType
     * @return bool
     */
    function isEmailUsed($mysqli, $email, $userType): bool
    {
        $memberModel = new RegistrationModel();

        // To be used in signup
        // If the email already exists in the database, return true
        if ($memberModel->getEmail($mysqli, $email, $userType)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Checks to see if the user exists in the database, true if they do, false if they don't.
     * @param $user
     * @return bool
     */
    function isLoginEmailWrong($user): bool
    {
        // To be used in login
        // If the user doesn't exist in database
        if (!$user) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Check to see if the password matches, if it does return true, false if not.
     * @param $password
     * @param $passwordHash
     * @return bool
     */
    function isPasswordWrong($password, $passwordHash): bool
    {
        // To be used in login
        // If the password doesn't match the password in database, return true
        if (!password_verify($password, $passwordHash)) {
            return true;
        } else {
            return false;
        }
    }

}

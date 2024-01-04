<?php

namespace Models;
include_once (__DIR__.'/Model.php');

class UpdateModel extends Model
{
    /**
     * Update user record based on email.
     * @param $mysqli
     * @param $firstName
     * @param $lastName
     * @param $email
     * @param $phone
     * @param $address
     * @param $userType
     * @return void
     */
    function updateUser($mysqli, $firstName, $lastName, $email, $phone, $address, $userType): void
    {
        $sql = "UPDATE ".$userType." 
                SET firstName = ?, lastName = ?, phone = ?, address = ?
                WHERE email = '".$email."';";

        $stmt = $mysqli->prepare($sql);

        $stmt->bind_param('ssss', $firstName, $lastName, $phone, $address);
        $stmt->execute();
    }
}
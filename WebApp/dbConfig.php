<?php

/**
 * Class to configure database
 */
class dbConfig
{
    private string $host = "localhost";
    private string $username = "root";
    private string $serverPassword = "";
    private string $dbName = "fitnessclub";
    private mysqli $mysqli;

    // Constructor to establish the connection
    public function __construct()
    {
        $this->mysqli = new mysqli($this->host, $this->username, $this->serverPassword, $this->dbName);
        if ($this->mysqli->connect_errno) {
            die("Failed to connect to MySQL server: " . $this->mysqli->connect_error);
        }
    }

    // Method to get the MySQLi connection
    public function getConnection(): mysqli
    {
        return $this->mysqli;
    }
}
<?php
require_once(__DIR__ . '/../../sessionConfig.php');
require_once(__DIR__ . '/../../dbConfig.php');

// Get the id from the session variable
$parts = explode('_', $_SESSION['userId']);
$memberId = $parts[0];
$id = $_GET['id'];

$dbConfig = new dbConfig();
$connection = $dbConfig->getConnection();

// Update the class record dependent on the id, redirect if successful else display error message
$sql = "UPDATE class SET memberId = $memberId WHERE id=$id";
if(mysqli_query($connection, $sql)){
    mysqli_close($connection);
    header("Location: ../../Views/pages/signUpSchedule.php");
    exit();
} else {
    echo "Error updating booking";
}

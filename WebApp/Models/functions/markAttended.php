<?php
require_once(__DIR__ . '/../../sessionConfig.php');
require_once(__DIR__ . '/../../dbConfig.php');
// Get the id from the URL parameter
$id = $_GET['id'];

$dbConfig = new dbConfig();
$connection = $dbConfig->getConnection();
// Update the member attendance of the record associated with the id to attended, redirect if successful
$sql = "UPDATE class SET memberAttendance = 'Attended' WHERE id=$id";
if(mysqli_query($connection, $sql)){
    mysqli_close($connection);
    header("Location: ../../Views/pages/schedule.php");
    exit();
} else {
    echo "Error updating booking";
}
<?php
require_once(__DIR__ . '/../../sessionConfig.php');
require_once(__DIR__ . '/../../dbConfig.php');
// Get the id from the URL parameter
$id = $_GET['id'];
$dbConfig = new dbConfig();
$connection = $dbConfig->getConnection();

// Delete the record associated with the id, redirect to the schedule page, setting the URL parameter success to 1 if successful
$sql = "DELETE FROM class WHERE id = $id";
if(mysqli_query($connection, $sql)){
    mysqli_close($connection);
    header("Location: ../../Views/pages/schedule.php?success=1");
    exit();
} else {
    echo "Error deleting record";
}

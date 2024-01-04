<?php
// unset and destroy session, redirect to the index page.
session_start();
session_unset();
session_destroy();
include "../Views/pages/header.php";
header("Location: ../Views/pages/index.php");
die();

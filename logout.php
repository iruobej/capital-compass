<?php
session_start();

$SESSION = array();
//Stopping the session completely 
session_destroy();

//Redirecting to login page
header("Location: login.html");
exit();
?>
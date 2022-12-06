<?php
// Initialize the session
session_start();
unset($_SESSION['type']);
unset($_SESSION['username']);
header("location: index.php");
 die();
// Unset all of the session variables
//$_SESSION = array();
 
// Destroy the session.
session_destroy();

 
// Redirect to login page

exit;
?>
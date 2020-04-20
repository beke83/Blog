<?php require_once("Include/session.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php 

$_SESSION["User_id"] =  null;
//kill a session
session_destroy();
Redirect_to("login.php");

?>
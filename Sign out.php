<?php
require_once"databaseConnector.php";
require_once"AppHeader.php";

function logUserOut(){
session_destroy();
return header('location:home.php');
}

logUserOut();


?>
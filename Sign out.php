<?php
require_once"databaseConnector.php";
require_once"AppHeader.php";

session_destroy();
return header('location:home.php');


?>
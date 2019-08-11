<?php
require_once"databaseConnector.php";

 session_start();

if($_SESSION["email"] != ""){
	require_once"loginHeader.php";
}
else{
	require_once"SignUpHeader.php";
}

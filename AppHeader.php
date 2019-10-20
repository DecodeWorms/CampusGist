<?php
require_once"databaseConnector.php";

function chooseHeader(){
 session_start();


if($_SESSION["email"] != ""){
	require_once"loginHeader.php";
}
else{
	require_once"SignUpHeader.php";
}

}

chooseHeader();
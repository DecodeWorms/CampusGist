<?php

$database_hostName = "localhost";
$database_database = "blogger";
$database_userName = "root";
$database_password = "";

   $database_server = mysql_connect(
                  $database_hostName,$database_userName,$database_password);
                  
mysql_select_db($database_database);
	
	
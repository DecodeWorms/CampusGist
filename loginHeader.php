<?php
require_once"databaseConnector.php";

 


session_start();
$userEmail = $_SESSION["email"];
$query = "SELECT Username FROM register 
            WHERE Email = '$userEmail'";
$result = mysql_query($query);
$userNameResult = mysql_fetch_array($result);
$userName = $userNameResult[0];

echo<<<___END
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="practice.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <body>
          <nav class="navbar fixed-top navbar-expand-lg bg-danger">
                <a href="#" class="nav-link text-white navbar-brand"><b>CampusGist</b></a>
                <span class="text-white"><b>$userName</b></span>
                <a href="SearchPosts.php" class="nav-link text-white float-right"><span class="glyphicon glyphicon-search"></span><b></b></a>
                <a href="Sign out.php" class="nav-link text-white"><span class="glyphicon glyphicon-log-out"></span></a>
                
         </nav>
  </body>
  </html>
___END;


?>
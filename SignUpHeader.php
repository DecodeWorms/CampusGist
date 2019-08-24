<?php
require_once"databaseConnector.php";
require_once"AppHeader.php";

echo<<<___END

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  
  <script src="../assets/js/boostrap.min.js"></script>
  <body>
          <nav class="navbar fixed-top navbar-expand-lg bg-danger">
         <a href="#" class="nav-link text-white navbar-brand"><b>CampusGist</b></a>
                             
         <a href="Sign up.php" class="nav-link text-white "><b>SIGN UP</b></a>

         <a href="Sign in.php" class="nav-link text-white "><b>SIGN IN</b></a>
      
      
                
         </nav>
  </body>
  </html>

___END;
?>
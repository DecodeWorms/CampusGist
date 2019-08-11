<?php
require_once"databaseConnector.php";

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
    <nav class="navbar fixed-top navbar-expand-lg bg-danger mt-3">
                <a href="home.php" class="nav-link text-white"><b>HOME</b></a>
                <a href="upload_blogs.php" class="nav-link text-white"><b>UPLOAD BLOGS</b></a>
                <a href="display_blog.php" class="nav-link text-white"><b>MY FEEDS</b></a>
                <a href="MyProfile.php" class="nav-link text-white"><span class="glyphicon glyphicon-user"></span></a>
                
         </nav>
</body>
</html>
___END;
?>
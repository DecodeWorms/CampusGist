<?php
require_once"databaseConnector.php";

echo<<<___END
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  
  <script src="../assets/js/boostrap.min.js"></script>

  <body>


 <div class="container-fluid">

         
          <nav class="navbar navbar-expand-lg bg-secondary mt-3 justify-fill">
                <a class="navbar-brand  text-white" href="#">BRAND</a>
                <a href="" class="nav-link text-white">HOME</a>
                <a href="" class="nav-link text-white">REGISTER</a>
                <a href="" class="nav-link text-white">SIGN IN</a>
                <a href="" class="nav-link text-white">UPLOAD</a>
                <a href="" class="nav-link text-white float-right">SIGN OUT</a>
         </nav>
 <div class="container-fluid mt-5">

<div id="formId">
        <form action="login.php" method="post">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" name="email"><br>
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" name="password"><br>
              <button type="" class="btn btn-primary btn-block btn-lg">SUBMIT</button>

        </form>
   </div>
   </div>
</body>
___END;


function login(){

  $email = $_POST["email"];
  $password = $_POST["password"];

  $emailQuery = "SELECT email FROM user
                 WHERE email = '$email'";
  $emailResult = mysql_query($emailQuery);

  $regEmail = mysql_fetch_array($emailResult);


  $passwordQuery = "SELECT password FROM user 
                    WHERE password = '$password'";

  $passwordResult = mysql_query($passwordQuery);

  $regPassword = mysql_fetch_array($passwordResult);

  if($regEmail[0] == $email && $regPassword[0] == $password && $email != "" && $password != ""){

    session_start();
    
    $_SESSION["email"] = $email;
    return header('location:display_blogs.php');
  }
  else{
    echo "pass not correct";
  }

}

login();
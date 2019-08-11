<?php
require_once"databaseConnector.php";
require_once"custom.php";
require_once"AppHeader.php";

$result = "";

function login(){
  
  session_start();

  global $result;

  $email = $_GET["email"];
  $password = $_GET["password"];

  $emailQuery = "SELECT email FROM register
                 WHERE email = '$email'";
  $emailResult = mysql_query($emailQuery);

  $regEmail = mysql_fetch_array($emailResult);


  $passwordQuery = "SELECT Password FROM register 
                    WHERE Email = '$email'";

  $passwordResult = mysql_query($passwordQuery);

  $regPassword = mysql_fetch_array($passwordResult);


  $confirmPasswordQuery = "SELECT Confirm_Password FROM register 
                    WHERE Email = '$email'";

  $confirmPasswordResult = mysql_query($confirmPasswordQuery);

  $confirmRegPassword = mysql_fetch_array($confirmPasswordResult);


  if($regEmail[0] == $email && $regPassword[0] == $password && $email != "" && $password != "" && $regPassword[0] == $confirmRegPassword[0]){

    session_start();
    
    $_SESSION["email"] = $email;
    return header('location:display_blog.php');
  }
  else{
    $result = "PLEASE ENTER CORRECT PASSWORD ";
  }

}

login();



echo<<<___END

<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
  <meta charset="utf-8">
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
<div class="conatiner">
	<div class="text-white text-center bg-warning mt-3" >$result</div>
   <div class="card mt-3" id="regCard">
    <div class="card-header bg-secondary text-white text-center">SIGN IN HERE</div>
     <div class="card-body">
         <form action="Sign in.php" method="get">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" name="email"><br>
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" name="password"><br>
              <button type="" class="btn btn-secondary btn-block btn-lg">SUBMIT</button><br>
              <a href = "RetreiveAccount.php" role = "button" class = "btn btn-secondary btn-block btn-lg"> FORGET PASSWORD</a>
        </form>
       </div>
    </div>
 </div>
</body>
</html>

___END;

//require_once"footer.php";
?>
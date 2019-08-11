<?php
require_once"databaseConnector.php";
require_once"custom.php";
require_once"AppHeader.php";

$accountResult = "";

function confirmAccount(){
  
  
  global $accountResult;

  $username = $_GET["username"];
  $university = $_GET["university"];
  $password = $_GET["password"];
  $confirmPassword = $_GET["confirmPassword"];

  $usernameQuery = "SELECT Username FROM register
                 WHERE Username = '$username'";
  $usernameResult = mysql_query($usernameQuery);

  $regUsername = mysql_fetch_array($usernameResult);


  $universityQuery = "SELECT University FROM register 
                    WHERE University = '$university'";

  $universityResult = mysql_query($universityQuery);

  $regUniversity = mysql_fetch_array($universityResult);

  if($regUsername[0] == $username && $regUniversity[0] == $university && $username != "" && $university != "" && $password != "" && confirmPassword != "" && $password == $confirmPassword){

    $query = "UPDATE register
                 SET Password = '$password', Confirm_Password = '$password'
                  WHERE Username = '$username'";

    $result = mysql_query($query);

    $accountResult = "PASSWORD SUCCESSFULLY CHANGED";
  }
  elseif($username == "" || $university == "" || $password == "" || $confirmPassword == ""){
    $accountResult = "ONE OR MORE OF THE FIELD IS(ARE) EMPTY";
  }
  elseif($regUsername[0] != $username){
    $accountResult = "PLEASE ENTER CORRECT USERNAME ";
  }
  elseif ($regUniversity[0] != $university) {
    $accountResult = "PLEASE ENTER CORRECT UNIVERSITY";
  }
  elseif ($password != confirmPassword) {
    $accountResult = "PLEASE MAKE SURE PASSWORD AND CONFIRM PASSWORD ARE MATCH!";
  }
  

}

confirmAccount();



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
	<div class="text-white text-center bg-warning mt-3" >$accountResult</div>
   <div class="card mt-3" id="regCard">
    <div class="card-header bg-secondary text-white text-center">ACCOUNT RECOVERY</div>
     <div class="card-body">
         <form action="RetreiveAccount.php" method="get">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" name="username"><br>
              <label for="university" class="form-label">University</label>
              <input type="text" class="form-control" name="university"><br>
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" name="password"><br>
              <label for="password" class="form-label" name="confirmPassword">Confirm Password</label>
              <input type="password" class="form-control" name="confirmPassword"><br>
              <button type="" class="btn btn-secondary btn-block btn-lg">SUBMIT</button><br>
        </form>
       </div>
    </div>
 </div>
</body>
</html>

___END;

//require_once"footer.php";
?>
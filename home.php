<?php
require_once"AppHeader.php";
require_once"databaseConnector.php";
require_once"custom.php";



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
  
  $userIdQuery = "SELECT Id FROM register 
                    WHERE Email = '$email'";
    $userIdQueryResult = mysql_query($userIdQuery);
    $userId = mysql_fetch_array($userIdQueryResult);

    $theUserId = $userId[0];


  if($regEmail[0] == $email && $regPassword[0] == $password && $email != "" && $password != "" && $regPassword[0] == $confirmRegPassword[0]){

    session_start();
    
    $_SESSION["email"] = $email;
    $_SESSION["userid"] = $theUserId;
    return header('location:display_blog.php');
  }
  else{
    $result = "PLEASE ENTER CORRECT PASSWORD ";
  }

}

login();

if ($_SESSION["email"] != ""){
  header("Location: display_blog.php");
}else{
echo<<<___END
<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="practice.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

  <script src="../assets/js/boostrap.min.js"></script>
  </head>

<body>
      <div class="row ml-3">
            <div class="col">
                <img src="../homePicture/studentsPhoto.jpg" style="width:300px; height:150px;">
                <p><b>CampusGist</b> is a social web application which is designed for Nigeria tertiary institution students for gisting and updating about what is happening in nigeria schools.<br>Users are expected to <b>register</b> if you are new or <b>login</b> directly if you have registered before
                </p>
            </div>
            <div class="col"><div class="text-white text-center bg-warning mt-3" >$result</div>
   <div class="card mt-3" id="regCard"> 
    <div class="card-header bg-secondary text-white text-center">SIGN IN HERE</div>
     <div class="card-body">
         <form action="home.php" method="get">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" name="email"><br>
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" name="password"><br>
              <button type="" class="btn btn-secondary btn-block btn-lg">SUBMIT</button><br>
        </form>
       </div>
    </div>
 </div></div>
      </div>
      <hr>
</body>
</html>
___END;

}

?>
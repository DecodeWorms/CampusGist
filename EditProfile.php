<?php

require_once"databaseConnector.php";
require_once"AppHeader.php";

$errorResult = "";


function editUserProfile(){

  global $errorResult;
  $sessionEmail = $_SESSION["email"];
  $userEmail = $_POST["email"];
  $newUsername = $_POST["newusername"];
  $userId = $_SESSION["userid"];

  
  $query = "SELECT Email FROM register 
            WHERE Email = '$userEmail'";
  $result = mysql_query($query);
  
  $emailResult = mysql_fetch_array($result);

 
  if($emailResult[0] == $sessionEmail && $userEmail != "" && $newUsername != ""
&& checkIfNewUserNameAlreadyExist() == true){

  	$editQuery = "UPDATE register 
  	       SET UserName = '$newUsername'
  	           WHERE Email = '$userEmail'";

    mysql_query($editQuery);
  	$errorResult = "PROFILE EDITED SUCCESSFUL";
    return true;

  }
  elseif($newUsername == "" || $userEmail == ""){
     $errorResult = "KINDLY INPUT CORRECT USER NAME";
     return false;
  }
  else{
  	$errorResult = "SORRY I GUESS USER NAME ALREADY EXIST OR EMAIL NOT EXIST";
    return false;
  }

  }

  function checkIfNewUserNameAlreadyExist(){

    $newusername = $_POST["newusername"];
    $query = "SELECT Username FROM register
               WHERE Username = '$newusername'";
    $result = mysql_query($query);
    $checkResult = mysql_fetch_array($result);
    

    if($checkResult[0] == ""){
      return true;
    }
    else{
      return false;
    }
  }


  function editUserProfileInOtherTables(){

    $sessionEmail = $_SESSION["email"];
    $newUsername = $_POST["newusername"];
    $userid = $_SESSION["userid"];
    
    $queryUsername = "SELECT Username FROM register
                        WHERE Email = '$sessionEmail'";
    $userNameResult = mysql_query($queryUsername);


    $userNameResult2 = mysql_fetch_array($userNameResult);

    $formalUsername = $userNameResult2[0];

    if(editUserProfile() == true){

      $usernameQueryPost = "UPDATE  usersposts
                  SET user_name = '$newUsername'
                  WHERE user_id = '$userid'";
      $result = mysql_query($usernameQueryPost);

      $usernameQueryComment = "UPDATE  userspostscomments
                  SET user_name = '$newUsername'
                  WHERE user_id = '$userid'";
      $resultComment = mysql_query($usernameQueryComment);

      $usernameQueryForSenderSendDm = "UPDATE  send_dm
                  SET Sender_Name = '$newUsername'
                  WHERE Sender_id = '$userid'";
      $resultForSenderSendDm = mysql_query($usernameQueryForSenderSendDm);

      


    }
    else{

    }

  }

//editUserProfile();
editUserProfileInOtherTables();


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
	<div class="text-white text-center bg-warning mt-3" id="regErr">$errorResult</div>
   <div class="card mt-3" id="regCard">
    <div class="card-header bg-secondary text-white text-center">EDIT PROFILE HERE<br>CHANGE USER NAME</div>
     <div class="card-body">
         <form action="EditProfile.php" method="post">
              <label for="email" class="form-label">User Email </label>
              <input type="email" class="form-control" name="email" ><br>
              <label for="username" class="form-label">New User name</label>
              <input type="text" class="form-control" name="newusername" placeholder="Enter new user name"><br>
              <button type="" class="btn btn-secondary btn-block btn-lg">SUBMIT</button>
        </form>
       </div>
    </div>
 </div>
</body>
</html>
___END;

 require_once"footer.php";

?>
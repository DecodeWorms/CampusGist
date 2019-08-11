<?php

require_once"databaseConnector.php";
require_once"AppHeader.php";

$errorResult = "";

function editUserProfile(){

  global $errorResult;
  $email = $_POST["email"];
  $username = $_POST["username"];
  
  $query = "SELECT Email FROM register 
            WHERE Email = '$email'";
  $result = mysql_query($query);
  
  $emailResult = mysql_fetch_array($result);

 
  if($emailResult[0] == $email && $username != ""){

  	$editQuery = "UPDATE register 
  	       SET UserName = '$username'
  	           WHERE Email = '$email'";

   mysql_query($editQuery);

  	$errorResult = "PROFILE EDITED SUCCESSFULLY";

  }
  elseif($username == ""){
     $errorResult = "KINDLY INPUT CORRECT EMAIL";
  }
  else{
  	$errorResult = "THIS EMAIL DOES NOT EXIST KINDLY INPUT CORRECT EMAIL";
  }

  }

editUserProfile();

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
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" name="email"><br>
              <label for="username" class="form-label">UserName</label>
              <input type="text" class="form-control" name="username"><br>
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
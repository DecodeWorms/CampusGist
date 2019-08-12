<?php
require_once"databaseConnector.php";
require_once"AppHeader.php";
require_once"custom.php";

 $user = new Custom();


$user->createTableRegister();
$user->createBloggerTable();
$user->createCommentTable();
//$result = $user->info;
$result = "";
$usernameErr = "";
$checkEmailErr = "";
$passwordsErr = "";


function insertUserInputToDB(){

  $user = new Custom();

  $error = "";

  global $result;
  $email = $_POST["email"];
  $username = $_POST["username"];
  $password = $_POST["password"];
  $confirmPassword = $_POST["confirmPassword"];
  $gender = $_POST["gender"];
  $state = $_POST["state"];
  $area = $_POST["area"];
  $university = $_POST["university"];
  $anImage = $_FILES["image"]["name"];

  $anImageLink = saveImagesToFolder($anImage);



  if($email != "" && $username != "" && $password != "" && $confirmPassword != "" && $gender != "" && $state != "" && $area != "" && $university != "" && $anImage != "" && VerifyIfEmailAlreadyExist() == false && VerifyIfUserNameAlreadyExist() == false && VerifyIfPasswordEqualtoConfirmPassword() == true){

  $query = "INSERT INTO register
            VALUES(0,'$email','$username','$password','$confirmPassword','$gender','$state','$area','$university','$anImageLink')";

            mysql_query($query);
            $result = "REGISTRATION IS COMPLETED";
          }
          elseif ($email == "") {
            $result = "Kindly register your informations properly";
          }
          elseif(VerifyIfEmailAlreadyExist() == true){
            $result = "Email already exist,kindly choose another email";
          }
          elseif (VerifyIfUserNameAlreadyExist() == true) {
          $result = "Username already exist,kindly choose another username";
          }
          elseif (VerifyIfPasswordEqualtoConfirmPassword() == false) {
          $result = "Password and Confirm Password are not MATCH!";
          }

}

insertUserInputToDB();

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
	<div class="text-white text-center bg-warning mt-3" id="regErr">$result</div>
   <div class="card mt-3" id="regCard">
    <div class="card-header bg-secondary text-white text-center">REGISTER HERE</div>
     <div class="card-body">
         <form action="Sign up.php" method="post" enctype="multipart/form-data">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" name="email"><br>
              <label for="username" class="form-label">UserName</label>
              <input type="text" class="form-control" name="username"><br>
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" name="password"><br>
              <labe for="confirmPassword" class="form-label"><b>Confirm Password</b></label>
              <input type="password" class="form-control" name="confirmPassword"><br>
              <label for="gender" class="form-label"><b>Gender</b></label>
              <select class="form-control" name="gender">
              <option>Male</option>
              <option>Female</option>
              </select><br>
              <label for="state" class="form-label">State</label>
              <select class="form-control" name="state">
                      <option>Abia</option>
                      <option>Adamawa</option>
                      <option>Akwa Ibom</option>
                      <option>Anambra</option>
                      <option>Bauchi</option>
                      <option>Bayelsa</option>
                      <option>Benue</option>
                      <option>Borno</option>
                      <option>Croos River</option>
                      <option>Delta</option>
                      <option>Ebonyi</option>
                      <option>Edo</option>
                      <option>Ekiti</option>
                      <option>Enugu</option>
                      <option>Gombe</option>
                      <option>Imo</option>
                      <option>Jigawa</option>
                      <option>kaduna</option>
                      <option>Kano</option>
                      <option>Katsina</option>
                      <option>Kebbi</option>
                      <option>Kogi</option>
                      <option>Kwara</option>
                      <option>Lagos</option>
                      <option>Nasarawa</option>
                      <option>Niger</option>
                      <option>Ogun</option>
                      <option>Ondo</option>
                      <option>Osun</option>
                      <option>Oyo</option>
                      <option>Plateau</option>
                      <option>River</option>
                      <option>Sokoto</option>
                      <option>Taraba</option>
                      <option>Yobe</option>
                      <option>Zamfara</option>
                    </select><br>
              <label for="area" class="form-label">Area</label>
              <input type="text" class="form-control" name="area"><br>
              <label for="university" class="form-label">University/Polytechnic/College of education</label>
              <input type="text" class="form-control" name="university"><br>
              <label class="form-label" for="image">Upload Image</label>
              <input type="file" name="image" class="form-control-file alert alert-secondary" placeholder="select picture"><br>
              <button type="" class="btn btn-secondary btn-block btn-lg">SUBMIT</button>
        </form>
       </div>
    </div>
 </div>
</body>
</html>
___END;



function VerifyIfEmailAlreadyExist(){
  
  $error = "";
  $username = $_POST["username"];
  $email = $_POST["email"];

  $query = "SELECT Email FROM register 
              WHERE Email  = '$email'";
  $result = mysql_query($query);

  $checkEmail = mysql_fetch_array($result);

  if($checkEmail[0] == $email){

    return true;
  }
  else{
    return false;
  }
}

function VerifyIfUserNameAlreadyExist(){
  
  
  $error = "";
  $username = $_POST["username"];
  $email = $_POST["email"];

  $query = "SELECT Username FROM register 
              WHERE Username  = '$username'";
  $result = mysql_query($query);

  $checkUserName = mysql_fetch_array($result);

  if($checkUserName[0] == $username){

    return true;
  }
  else{
    return false;
  }
}

function VerifyIfPasswordEqualtoConfirmPassword(){
  
  
  $password = $_POST["password"];
  $confirmPassword = $_POST["confirmPassword"];

  if($password == $confirmPassword)
    return true;
  else
    return false;
}



function saveImagesToFolder($actualImage){

    $imageFolder = "../pictures";
   
    $anImageLink = "";
 
  if($actualImage){

    $anImageLink = $imageFolder."/".$actualImage;
     move_uploaded_file($_FILES["image"]["tmp_name"],$anImageLink);

     return $anImageLink;
}

}

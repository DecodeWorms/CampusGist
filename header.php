<?php

$user = new Session();

if($user->getLoginStatus() == true){
	$username = $user->getUserName();


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


<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
     
      <li class="nav-item">
        <a class="nav-link" href="#">username</a>
      </li>

   <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="#">logout</a>
      </li>
     
    </ul>
  </div>
     
    </ul>
  </div>
</nav>

___END;

} else{
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
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="#">login</a>
      </li>
     

     <li class="nav-item">
        <a class="nav-link" href="#">signup</a>
      </li>
    </ul>
  </div>
</nav>

___END;
}
     









/**
 * 
 */
  Class Session{

	// private $email;
	// private $username;
	private $loged_in = false;
	
	function __construct()
	{
	   //self::setSession();
	}

	function setSession($email,$username){
		    session_start();

	      $this->loged_in = true;
        $_SESSION["email"] = $email;
        $_SESSION["username"] = $username;
	}



    function getLoginStatus(){

	   if($this->loged_in == true){
		    return true;
	   }
	   else{
		    return false;
	   }
    }


    function getEmail(){
	  return $this->email;
    }

    function getUserName(){
	  return $this->username;
    }

}
 
    
<?php
require_once"databaseConnector.php";
require_once"AppHeader.php";


$errResult = "";
echo<<<___END

<!DOCTYPE html>
<html>
<head>
	<title></title>
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

</head>
<body>
    <div class="container">
    <div class = "bg bg-warning text-center">$errResult</div>
    	<form action="SearchPosts.php" method="get">
    		<label class="form-label" for="search"></label>
    		<input type="text" name="search" placeholder="Search for user posts here..." class="form-control"><button type="" class="btn btn-secondary mt-2">search</button>
    	</form>
    </div>
</body>
</html>

___END;

 function searchUserPosts(){
    
    session_start();

    global $errResult;

    $userName = $_GET["search"];
    
    $_SESSION["username"] = $userName;
    
 	$query = "SELECT*FROM register 
 	           WHERE username = '$userName'";

 	$result = mysql_query($query);

  $errResult = "HELLO";
  

 	while ($row = mysql_fetch_array($result,MYSQL_ASSOC)) {

    if($row[Username] != $username )
      $errResult = "USER NAME UNKNOWN";
    else
      $errResult = "SUCCESSFULLY FOUND";
	
echo<<<___END
<!DOCTYPE html>
<html>
<head>
	<title></title>
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

</head>
<body

    <div class = "">
    <a href = "userSearchedProfile.php" class = "text-secondary ml-4 mt-3" style = "text-decoration:none;">
         <img src = "$row[image]" style="width: 55px; height:55px;" class="img-circle ml-4 mt-3"><br>
         <h5 class = "ml-4">$row[Username]</h5>
   </a>
    </div>
    <hr>

</body>
</html>

___END;

 	}
 }

 searchUserPosts();

 

require_once"footer.php";
?>
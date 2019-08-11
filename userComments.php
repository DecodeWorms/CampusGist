<?php
require_once"databaseConnector.php";
require_once"AppHeader.php";
// require_once"display_blog.php";
// session_start();
 
 echo "<b>COMMENTS</b>";
 
 $userName = $_SESSION["email"];

 function fetchUserComments(){

 	session_start();
 	$postId = $_SESSION["postIdNumber"];
 	// echo $postId;
   
 	$query = "SELECT*FROM comments 
 	          WHERE post_id = '$postId'";
 	$result = mysql_query($query);

 	while($row = mysql_fetch_array($result,MYSQL_ASSOC)){
    
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

  <div class = "container-fluid">
  
       <div class = "">
           <p><b>$row[user_name]</b> : $row[comments]</P>
       </div>
       <hr>
  </div>
</body>
</html>
___END;

 	}
 	$row++;
 }

fetchUserComments();

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

  <div class = "container-fluid">
  
      <form class = "userComments.php" method = "post">
           <label for = "comment" class ="form-label"><b><i>$userName</i></b></label>
           <input type = "text" class = "form-control" name = "comment" placeholder = "Writes here..."><br>
           <button type = "" class = "btn btn-secondary">post</button>
      </form>
  </div>
</body>
</html>
___END;

// fetchUserComments();

// var_dump($_SESSION["email"]);


function addComments(){
    
  global $userName;
	$postId = $_SESSION["postIdNumber"];
	// $userName = $_SESSION["email"];
	$comment = $_POST["comment"];

	if($postId != "" && $userName != "" && $comment != ""){

		$query = "INSERT INTO comments
		          VALUES(0,'$userName','$postId','$comment')";
		mysql_query($query);
	}
}

addComments();
require_once"footer.php";
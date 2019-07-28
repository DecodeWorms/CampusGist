<?php
require_once"databaseConnector.php";
require_once"AppHeader.php";
require_once"Custom.php";


$aUserName = $aUserEmail = $aUserImage = "";

function getUserName(){

 global $aUserName;
 $userEmail = $_SESSION["email"];

 $query = "SELECT username FROM register 
            WHERE Email = '$userEmail'";
 $result = mysql_query($query);

 $userName = mysql_fetch_array($result);

 $aUserName = $userName[0];
}

function getUserEmail(){
	global $aUserEmail;
	$aUserEmail = $_SESSION["email"];
}

function getUserImage(){

   global $aUserImage;
   $userEmail = $_SESSION["email"];
   $query = "SELECT image FROM register 
             WHERE Email = '$userEmail'";
   $result = mysql_query($query);

   $userImage = mysql_fetch_array($result);

   $aUserImage = $userImage[0];
}

 getUserName();
 getUserEmail();
 getUserImage();

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
       <div class = "card">
           <div class = "card-header bg-secondary text-center text-white"><a href = "EditProfile.php" class="text-white" style="text-decoration:none;">EDIT PROFILE</a></div>
           </div>
           <div class = "card-body">
           <img src="$aUserImage" style="width: 100px; height:100px;" class="img-circle"><br><br>
               <label for = "full name" class = "form-label"><b><i>User Name : $aUserName</b></i></label><br><br>
               <label for = "Email" class = "form-label"><b><i>User Email : $aUserEmail</b></i></label>

           </div>
       </div>
       <hr>
</body>
</html>
___END;

function fetchBlogs(){


   session_start();
   $userEmail = $_SESSION["email"];

   $query = "SELECT username FROM register 
              WHERE Email = '$userEmail'";
   $result = mysql_query($query);

   $username = mysql_fetch_array($result);

   $aname = $username[0];

   $_SESSION["userId"] = $aname;

   $feedQuery = "SELECT * FROM blogger
                 WHERE user_id = '$aname'
                 ORDER BY id DESC";
   $feedResult = mysql_query($feedQuery);
   

  
   while($row = mysql_fetch_array($feedResult,MYSQL_ASSOC)){

     $postId = $row[id];

      $numComments = numberOfComments($postId);
        
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
  
  <link rel = "stylesheet" href = "../assets/css/practices.css">

  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

  <script src="../assets/js/boostrap.min.js"></script>

<body>

    <div class="card">

      <div class="card-header bg-secondary text-white">
           <img src="$row[user_Image]" style="width: 50px; height:50px;" class="img-circle ml-1 mt-3"><span class="ml-3" ><b>$row[user_id]</b></span>
      </div>

      <div class="card-body">
        <img src="$row[image]">

      <div class="card-title mt-2"><p><b>$row[user_id]</b> $row[description]</p></div>
      
     <form action="userComments.php" method="post">
     <input type="hidden" class="form-control" placeholder="" name="idNumber" value="$postId">
     <p>time posted</p>
       <button class="btn btn-secondary mt-1 mb-2">$numComments comments</button>
     </form>

  <form action="display_blog.php" method="post">
       <input type="hidden" class="form-control" placeholder="" name="idNumber" value="$postId">
       <input type="text" class="form-control" placeholder="Add comment" name="comments">
       <button class="btn btn-secondary mt-1">post</button>
     </form>
      </div>

</html>
</body>

___END;
$row++;   
}
}

function getPostIdToCommentOn(){

      // session_start();
      $user  = new custom();
      $user->createCommentTable();
      $commentatorId = $_SESSION["email"];
      $postUniqueId = $_POST["idNumber"];
      $comments = $_POST["comments"];

      if($postUniqueId != "" && $comments != ""){
        $query = "INSERT INTO comments
                  VALUES(0,'$commentatorId','$postUniqueId','$comments')";
                  mysql_query($query);
      }

    }

    function fetchComments(){

      $_SESSION["postIdNumber"] = $_POST["idNumber"];

    }

    function numberOfComments($anId){

      $idQuery = "SELECT post_id FROM  comments 
                 WHERE post_id = '$anId'";
      $idResult = mysql_query($idQuery);
      $idResult2 = mysql_num_rows($idResult);
      return $idResult2;
    }
  
 fetchBlogs();
 getPostIdToCommentOn();
 fetchComments();




require_once"footer.php";
hfuh
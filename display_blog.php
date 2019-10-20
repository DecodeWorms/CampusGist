<?php
require_once"databaseConnector.php";
require_once"AppHeader.php";
require_once"custom.php";


function createTablePosts(){

  $query = "CREATE TABLE userspostscomments(
            id int AUTO_INCREMENT NOT NULL PRIMARY KEY,
            user_id int  NOT NULL,
            user_name char(25) NOT NULL,
            post_id int NOT NULL,
            comments varchar(1000) NOT NULL)";
  mysql_query($query);
}

createTablePosts();


function fetchBlogs(){

   session_start();

   $query = "SELECT*FROM usersPosts ORDER BY id DESC LIMIT 20";

   $result = mysql_query($query);

  
   while($row = mysql_fetch_array($result,MYSQL_ASSOC)){

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
           <img src="$row[user_image]" style="width: 50px; height:50px;" class="img-circle ml-1 mt-3"><span class="ml-3" ><b>$row[user_name]</b></span>
      </div>

      <div class="card-body">
        <img src="$row[image]">

      <div class="card-title mt-2"><p><b>$row[user_name]</b> $row[post_description]</p></div>
     
     <form action="display_blog.php" method="post">
     <input type="hidden" class="form-control" placeholder="" name="idNumber" value="$postId">
      <input type="submit" name="click" value="view all $numComments comments " class="btn btn-sm mb-2"><br>
       $row[time_occured]

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
loadToComments();
$row++; 

}
}



function postUserComments(){

      // session_start();
      //$user  = new custom();
      //$user->createCommentTable();
      $email = $_SESSION["email"];
      $usernameQuery = "SELECT Username FROM register 
                            WHERE Email = '$email'";
      $usernameQueryResult = mysql_query($usernameQuery);
      $username = mysql_fetch_array($usernameQueryResult);

      $commentatorId = $_SESSION["email"];
      $postUniqueId = $_POST["idNumber"];
      $comments = $_POST["comments"];
      $userId = $_SESSION["userid"];
      $theUsername = $username[0];

      if($postUniqueId != "" && $comments != "" && $userId != ""){
        $query = "INSERT INTO userspostsComments
                  VALUES(0,'$userId','$theUsername','$postUniqueId','$comments')";
                  mysql_query($query);
      }
    }



    function numberOfComments($anId){

      $idQuery = "SELECT post_id FROM  usersPostsComments 
                 WHERE post_id = '$anId'";
      $idResult = mysql_query($idQuery);
      $idResult2 = mysql_num_rows($idResult);
      return $idResult2;
    }

    function loadToComments(){

      if(isset($_POST["click"])){
         $_SESSION["postIdNumber"] = $_POST["idNumber"];
         return header('location:userComments.php');
       }
       else{
          return "";
       }
      
    }
 fetchBlogs();
 postUserComments();
require_once"footer.php";


?>
<?php
require_once"databaseConnector.php";
require_once"custom.php";
require_once"AppHeader.php";

$result = "";

function saveAndPost(){

   global $result;

   session_start();
   
   $email = $_SESSION["email"];

   $query = "SELECT Username FROM register 
                WHERE Email = '$email'";

   $result = mysql_query($query);


   $userName = mysql_fetch_array($result);

  

	  $emailQuery = "SELECT image FROM register 
	              WHERE Email = '$email'";

	  $emailResult = mysql_query($emailQuery);

	  $userImage = mysql_fetch_array($emailResult);


  	 $userid = $userName[0];
  	 $userIdImage = $userImage[0];
  	 $title = $_POST["title"];
  	 $description = $_POST["description"];

  	 $image = saveImagesToFolder($_FILES["image"]["name"]);
      
      if($email != "" && $userid != "" && $title != "" && $description != "" && $image != "" && $userIdImage != ""){

  	 $insertQuery = "INSERT INTO blogger
           VALUES(0,'$userid','$title','$image','$userIdImage','$description')";

  	    mysql_query($insertQuery);
  	    $result = "BLOG POSTING IS COMPLETED";
  	}
  	elseif($title == "" || $description == "" || $image == ""){

  		$result = "KINDLY UPLOAD UR BLOG PROPERLY";
  	}
    else{
      $result = "INPUT IS NOT VALID";
    }
  
  	//var_dump($email);
  }

saveAndPost();
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
	<div class="text-white text-center bg-warning mt-3" id="regErr">$result</div>
   <div class="card mt-3" id="uploadCard">
    <div class="card-header bg-secondary text-white text-center">UPLOAD YOUR POST HERE</div>
     <div class="card-body">
         <form action="upload_blogs.php" method="post" enctype="multipart/form-data">
              <label for="title" class="form-label">Title</label>
              <input type="text" class="form-control" name="title"><br>
              <label class="form-label" for="image">Upload Image</label>
              <input type="file" name="image" class="form-control-file alert alert-secondary" placeholder="select picture"><br>
              <label class="form-label" for="description">Description</label>
              <textarea class="form-control" cols="8" rows="10" name = "description" placeholder="write description here..."></textarea>
            	<br>
              <button type="" class="btn btn-secondary btn-block btn-lg">SUBMIT</button>
        </form>
       </div>
    </div>
</body>
</html>
___END;



 function saveImagesToFolder($actualImage){

    $imageFolder = "../postPictures";
   
    $anImageLink = "";
 
  if($actualImage){

    $anImageLink = $imageFolder."/".$actualImage;
     move_uploaded_file($_FILES["image"]["tmp_name"],$anImageLink);

     return $anImageLink;
}

}

$customFunc = new Custom();
$customFunc->createUsersPosts();

require_once"footer.php"; 
?>

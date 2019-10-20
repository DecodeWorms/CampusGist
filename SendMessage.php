<?php
require_once"databaseConnector.php";
require_once"AppHeader.php";


$senderName = "";
$receiverName = "";
$messages = "";
$receiverImage = "";
$receiverId = "";
$senderId = "";

function createChatTable(){

	$query = "CREATE TABLE send_dm(
	  Chat_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Sender_id int NOT NULL,
    Sender_Receiver int  NOT NULL,
    Messages varchar(1500) NOT NULL,
    Sender_Name char(25) NOT NULL

)";

$result = mysql_query($query);
}

function getReceiverImage(){
  global $receiverImage;
  global $receiverName;

  $query = "SELECT image FROM register 
               WHERE Username = '$receiverName'";
  $result = mysql_query($query);

  $image = mysql_fetch_array($result);

  $receiverImage = $image[0];

  
}


function getSenderName(){

 global $senderName;
 $email = $_SESSION["email"];

 $query = "SELECT Username FROM register 
              WHERE Email = '$email'";
 $result = mysql_query($query);
 $queryName = mysql_fetch_array($result);
 $senderName = $queryName[0];

 
}


function getReceiverName(){

  global $receiverName;
  $receiverName = $_SESSION["username"];
}

function getReceiverId(){
  global $receiverName;
  global $receiverId;
  $query = "SELECT Id FROM register 
                 WHERE Username = '$receiverName'";
  $result = mysql_query($query);

  $getResult = mysql_fetch_array($result);
  $receiverId = $getResult[0];
}

getSenderName();
getReceiverName();
getReceiverImage();
getReceiverId();



createChatTable();





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
      <div class = "container-fluid">
       <div class = "">
           <img src="$receiverImage" style="width: 50px; height:50px;" class="img-circle"><h4 class=""><b> $receiverName</b></h4>
        </div>
       
  </div>
</body>
</html>
___END;



 function fetchMessages(){
  global $receiverId;
  
  $senderId = $_SESSION["userid"];
  $senderReceiverName = $senderId.$receiverId;
  $receiverSenderName = $receiverId.$senderId;

  $query = "SELECT*FROM send_dm 
             WHERE Sender_Receiver = $senderReceiverName OR Sender_Receiver = $receiverSenderName";
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
  
  <link rel = "stylesheet" href = "../assets/css/practices.css">

  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

  <script src="../assets/js/boostrap.min.js"></script>
<body>
      <div class = "container-fluid">
           <div class=""><b>$row[Sender_Name]</b> $row[Messages] </div>
       <hr>
       
  </div>
</body>
</html>
___END;

}
$row++;
}

fetchMessages();


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
           <label for = "comment" class ="form-label"><b><i>$senderName</i></b></label>
           <input type = "text" class = "form-control" name = "message" placeholder = "Writes here..."><br>
           <button type = "" class = "btn btn-secondary">send message</button>
      </form>
  </div>
</body>
</html>
___END;

function sendDm(){
  global $senderName;
  global $messages;
  global $receiverId;
  global $senderId;

  $messages = $_POST["message"];
  $senderId = $_SESSION["userid"];
  $senderReceiverName = $senderId.$receiverId;

  if($senderName != "" && $messages != "" && $senderReceiverName != "" ){

  $query = "INSERT INTO send_dm 
              VALUES(0,$senderId,$senderReceiverName,'$messages','$senderName')";
  $result = mysql_query($query);
}
else{
   return "Message did not send";

 }
 

}

sendDm();

require_once"footer.php";
?>
<?php
require_once"databaseConnector.php";
  
  Class Custom{

   // public $successfulRegistered = "";
   // public $unsuccessfulRegistered = "";
      //public $info = "";

   function createTableRegister(){

      $query = "CREATE TABLE register
                (Id int AUTO_INCREMENT NOT NULL PRIMARY KEY,
                 Email char(50) NOT NULL,
                 Username char(30) NOT NULL,
                 Password char(30) NOT NULL,
                 Confirm_Password char(30) NOT NULL,
                 Gender char (7) NOT NULL,
                 State char (20) NOT NULL,
                 City char(30) NOT NULL,
                 University char (50) NOT NULL,
                 image BLOB NOT NULL
                 )"; 

      mysql_query($query);
    }

    function createBloggerTable(){
      $query = "CREATE TABLE blogger (
      id int AUTO_INCREMENT NOT NULL PRIMARY KEY,
      user_id char(100) NOT NULL,
      title char(100) NOT NULL,
      image BLOB NOT NULL,
      user_Image BLOB NOT NULL,
      description varchar(1000) NOT NULL)
      ";
        

      $result = mysql_query($query);
    
    }



   //  function dropColumnTime(){

   //         $query = "ALTER TABLE blogger
   //           DROP COLUMN timeOccured";

   //           mysql_query($query);
   // }

    



    function createUsersPosts(){

      $query = "CREATE TABLE posts (
      id int AUTO_INCREMENT NOT NULL PRIMARY KEY,
      user_id char(100) NOT NULL,
      title char(100) NOT NULL,
      image BLOB NOT NULL,
      user_Image BLOB NOT NULL,
      description varchar(1000) NOT NULL,
      time char(20) NOT NULL)
      ";
        

      $result = mysql_query($query);
    }
    
    function errorHandler($error){
     
     if($error == true){
      echo "successfulRegistered";
     }
     else {
       
      echo  "unsuccessfulRegistered";
     }
    
  }

  function createCommentTable(){
  $query = "CREATE TABLE comments(
             id int  AUTO_INCREMENT NOT NULL PRIMARY KEY,
             user_name char(50) NOT NULL, 
             post_id char(50) NOT NULL,
             comments varchar(2000)
            )";

   mysql_query($query);
  }
}

  

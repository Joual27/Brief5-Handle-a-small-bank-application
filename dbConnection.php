<?php
   define("server", "localhost");
   define("username", "root");
   define ("password" , "");
   define("database", "db_mini_bank_app");


   $cnx = new mysqli(server,username,password,database);

  if($cnx->connect_error){
      die("Couldn't connect !". $cnx->connect_error);
  }
   
?>
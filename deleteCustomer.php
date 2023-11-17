<?php

 include ("dbConnection.php");
 include("redirectUser.php");

 $customerId = $_GET["id"];

 $deleteCustomerQuery = "delete from customer where customerId = $customerId";

 try {
    $cnx->query($deleteCustomerQuery);
    redirect("index.php",false);
 }
 catch(Exception $e){
    die("invalid query" . $e->getMessage());
 }
?>
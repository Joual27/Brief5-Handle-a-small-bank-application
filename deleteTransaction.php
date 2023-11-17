<?php
  include("dbConnection.php");

  $id = $_GET["id"];

  try{
    $deleteTransactionQuery = " delete from transaction where transactionId = $id";

    $cnx->query($deleteTransactionQuery);
    include("redirectUser.php");
    redirect("transactions.php",false);
  }

  catch (Exception $e){
    die ("invalid query !" . $e->getMessage());
  }

?>
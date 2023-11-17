<?php 

include("dbConnection.php");

$id = $_GET["id"];

$deleteAccountQuery = "delete from account where accountId = $id";

try{
    $cnx->query($deleteAccountQuery);
    include("redirectUser.php");
    redirect("accounts.php");
}
catch(Exception $e){
    die ("invalid query" . $e->getMessage());
}
?>
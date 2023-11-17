<?php

function createRib(){
   $date = date("siHdmY");
   $rib = substr($date,0,16);
   return $rib ;
}

include("dbConnection.php");


if($_SERVER["REQUEST_METHOD"] == "POST"){

    $balance = $_POST["balance"];
    $currency = $_POST["currency"];
    $customer = $_POST["customer"];
    $RIB = createRib();
   
    $addAccountQuery = "insert into account(balance,currency,customerId,RIB) values (?,?,?,?)" ;

    $errorMsg = "";


    if(empty($balance) || empty($currency) || $customer == "select account's owner"){
       $errorMsg = "all fields are required !" ;
    }

    else{
        $stmt = $cnx->prepare($addAccountQuery);
        $stmt->bind_param("dsis",$balance,$currency,$customer,$RIB);


        try {
            $stmt->execute();
            include("redirectUser.php");
            redirect("accounts.php", false);
        }
        catch(Exception $e){
        die("Invalid query" . $e->getMessage());
        }
    }

   
}







?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Bank-X</title>
</head>
<body class="bg-violet-400 h-[100vh] w-full relative">
    <!-- <div class="w-full h-full bg-black opacity-10 z-50  absolute top-0 left-0 hidden"></div> -->
    <div class="w-full h-full flex items-center justify-center">
        <main class="w-[70%] h-[80%] bg-white rounded-3xl text-gray-500 mx-auto  relative">
           
        <?php include("navbar.php") ; ?>

            <div>
                <div class=" px-[2.5rem] my-[2rem] flex justify-center">
                <h3 class="text-center text-[1.25rem] font-semibold text-violet-500">Add Account Form:</h3>
                </div>
                
            </div>
            <form method="POST" class="w-[40%] mx-auto">
                <div class="flex flex-col gap-[7px]">
                    <label for="Balance"> Balance :</label>
                    <input type="text" name="balance" class="focus:outline-none bg-violet-200 font-semibold rounded-lg p-[0.4rem]">
                    
                </div>
                <div class="flex flex-col gap-[7px]">
                    <label for="currency">Currency :</label>
                    <input type="text" name="currency" class="focus:outline-none bg-violet-200 font-semibold rounded-lg p-[0.4rem]">
                </div>

                <div class="flex flex-col gap-[7px]">
                    <label for="customer">Customer :</label>
                    <select name="customer" class="focus:outline-none bg-violet-200 font-semibold rounded-lg p-[0.4rem]">
                        <option value="select account's owner">select account's owner</option>
                        <?php
                            $bringAllCustomersQuery = "select * from customer";
                            $customersData = $cnx->query($bringAllCustomersQuery);
                            foreach ($customersData as $customer){
                                echo "<option value='$customer[customerId]'>$customer[familyName]</option>";
                            }
                        ?>
                    </select>
                   
                </div>
                <p class="text-violet-500 font-semibold"><?php
                  
                  if(!empty($errorMsg)){
                    echo $errorMsg;
                  }
                
                ?></p>
               

                <input type="submit" value="Submit Data" class="w-[25%] h-[2rem] bg-violet-500 mx-[37.5%] text-white rounded-sm mt-[2rem] cursor-pointer">
 </form>
    
    
        </main>
    </div>    
    
    
</body>
</html>
<?php

include("dbConnection.php"); 
$id = $_GET["id"];

$bringTransctionsDataQuery = "select * from customer JOIN account ON account.customerId = customer.customerId JOIN transaction ON transaction.accountId = account.accountId where account.accountId = $id";
$datas = $cnx->query($bringTransctionsDataQuery);

$infos = $datas->fetch_assoc();


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
                <div class=" px-[2.5rem] my-[2rem] flex justify-between items-center">
                <h3 class="text-center text-[1rem] font-semibold text-violet-500">
                    <?php
                       if(empty($infos)){
                         echo " No Transactions Made By This Account ";
                       }
                       else {
                        echo "
                          Transactions Of Account : $infos[RIB] , OWNER : $infos[familyName];
                        " ;
                       }
                    ?>
                </h3>
                
                </div>
                <table class="w-[92.5%] mx-auto border-2 border-gray-300 font-semibold text-[0.9rem]">
                    <tr class="w-full text-violet-600 ">
                        <td class="border-2 border-gray-300 p-[0.4rem]">ID</td>
                        <td class="border-2 border-gray-300 p-[0.4rem]">WAGE</td>
                        <td class="border-2 border-gray-300 p-[0.4rem]">TYPE</td>
                        <td class="border-2 border-gray-300 p-[0.4rem]">ACCOUNT'S RIB</td>
                        <td class='border-2 border-gray-300 p-[0.4rem]'>ACCOUNT'S OWNER</td>
                    </tr>
                    <?php

                        foreach($datas as $data){
                            echo "
                            <tr class='w-full text-gray-600 '>
                                <td class='border-2 border-gray-300 p-[0.4rem]'>$data[transactionId]</td>
                                <td class='border-2 border-gray-300 p-[0.4rem]'>$data[wage]</td>
                                <td class='border-2 border-gray-300 p-[0.4rem]'>$data[type]</td>
                                <td class='border-2 border-gray-300 p-[0.4rem]'>$data[RIB]</td>
                                <td class='border-2 border-gray-300 p-[0.4rem]'>$data[familyName]</td>
                            </tr>
                           ";
                           }
                    ?>

                </table>
            </div>
        
    
        </main>
    </div>    
    
    
</body>
</html>
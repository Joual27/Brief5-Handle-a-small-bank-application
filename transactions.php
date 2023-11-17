<?php 


include("dbConnection.php");



$bringTransctionsDataQuery = "select * from customer JOIN account ON account.customerId = customer.customerId JOIN transaction ON transaction.accountId = account.accountId;";
$transactions = $cnx->query($bringTransctionsDataQuery);

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
                <h3 class="text-center text-[1.25rem] font-semibold text-violet-500">Transactions Dashboard :</h3>
                <a href="addTransaction.php"class="px-[0.4rem] py-[0.3rem] bg-violet-500 text-white">Add New Transaction</a>
                </div>
                <table class="w-[92.5%] mx-auto border-2 border-gray-300 font-semibold text-[0.9rem]">
                    <tr class="w-full text-violet-600 ">
                        <td class="border-2 border-gray-300 p-[0.4rem]">ID</td>
                        <td class="border-2 border-gray-300 p-[0.4rem]">WAGE</td>
                        <td class="border-2 border-gray-300 p-[0.4rem]">TYPE</td>
                        <td class="border-2 border-gray-300 p-[0.4rem]">ACCOUNT'S RIB</td>
                        <td class='border-2 border-gray-300 p-[0.4rem]'>ACCOUNT'S OWNER</td>
                        <td class="border-2 border-gray-300 p-[0.4rem]">ACTIONS</td>
                    </tr>
                    <?php
                         
                        function bringRIB ($id){
                            global $cnx;
                            $sql = "select * from account where accountId = $id";
                            $res = $cnx->query($sql);
                            $transaction = $res->fetch_assoc();
                            return $transaction["RIB"];
                        }
                      
                         
                        foreach($transactions as $transaction){
                           
                            echo "
                                <tr class='w-full text-gray-600'>
                                    <td class='border-2 border-gray-300 p-[0.4rem]'>$transaction[transactionId]</td>
                                    <td class='border-2 border-gray-300 p-[0.4rem]'>$transaction[wage]</td>
                                    <td class='border-2 border-gray-300 p-[0.4rem]'>$transaction[type]</td>
                                    <td class='border-2 border-gray-300 p-[0.4rem]'>$transaction[RIB]</td>
                                    <td class='border-2 border-gray-300 p-[0.4rem]'>$transaction[familyName]</td>
                                    <td class='border-2 border-gray-300 p-[0.4rem]'>
                                        <a href='deleteTransaction.php?id=$transaction[transactionId]' class='px-[0.4rem] py-[0.2rem] bg-red-600 text-white'>Delete</a>
                                    </td>
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
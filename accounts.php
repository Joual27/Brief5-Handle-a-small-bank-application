<?php
   include("dbConnection.php");

   $bringAccountsData = "select * from account" ;
   $accounts = $cnx->query($bringAccountsData); 

   function convertIdToName($id){
     $name = "select * from customer where customerId = $id";
     global $cnx;
     try{
        $res = $cnx->query($name);
        $customer = $res->fetch_assoc();
        return $customer["familyName"];
     }

     catch(Exception $e){
        die("error". $e->getMessage());
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
                <div class=" px-[2.5rem] my-[2rem] flex justify-between items-center">
                <h3 class="text-center text-[1.25rem] font-semibold text-violet-500">Accounts Dashboard :</h3>
                <a href="addAccount.php"class="px-[0.4rem] py-[0.3rem] bg-violet-500 text-white">Add New account</a>
                </div>
                <table class="w-[92.5%] mx-auto border-2 border-gray-300 font-semibold text-[0.9rem]">
                    <tr class="w-full text-violet-600 ">
                        <td class="border-2 border-gray-300 p-[0.4rem]">ID</td>
                        <td class="border-2 border-gray-300 p-[0.4rem]">RIB</td>
                        <td class="border-2 border-gray-300 p-[0.4rem]">Balance</td>
                        <td class="border-2 border-gray-300 p-[0.4rem]">Currency</td>
                        <td class="border-2 border-gray-300 p-[0.4rem]">customer Name </td>
                        <td class="border-2 border-gray-300 p-[0.4rem]">ACTIONS</td>
                    </tr>
                    <?php
                   
                    if($accounts->num_rows > 0){
                        foreach($accounts as $account){
                           $customerName = convertIdToName($account["customerId"]);
                           echo "   
                                <tr class='w-full text-gray-600'>
                                    <td class='border-2 border-gray-300 p-[0.4rem]'>$account[accountId]</td>
                                    <td class='border-2 border-gray-300 p-[0.4rem]'>$account[RIB]</td>
                                    <td class='border-2 border-gray-300 p-[0.4rem]'>$account[balance]</td>
                                    <td class='border-2 border-gray-300 p-[0.4rem]'>$account[currency]</td>
                                    <td class='border-2 border-gray-300 p-[0.4rem]'>$customerName</td>
                                    <td class='border-2 border-gray-300 p-[0.4rem]'>
                                    <a href='editAccount.php?id=$account[accountId]' class='px-[0.4rem] py-[0.2rem] bg-black text-white'>Edit</a>
                                    <a href='deleteAccount.php?id=$account[accountId]' class='px-[0.4rem] py-[0.2rem] bg-red-600 text-white'>Delete</a>
                                    <a href='transactionsOfAccount.php?id=$account[accountId]' class='px-[0.4rem] py-[0.2rem] bg-gray-300 text-white'>see Transactions</a>
                                    </td>
                                </tr>
                            ";
                        
                        }
                    }
                      
                    
                    ?>
                    
                </table>
            </div>
        
    
        </main>
    </div>    
    
    
</body>
</html>
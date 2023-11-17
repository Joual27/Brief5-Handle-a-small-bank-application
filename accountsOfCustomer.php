<?php
 include("dbConnection.php");

 $id = $_GET["id"];
  
 $bringAccountData = "select * from account where customerId = $id";
 $accountsPerCustomer = $cnx->query($bringAccountData);

 $bringCustomerData = "select * from customer where customerId = $id" ; 
 $result = $cnx->query($bringCustomerData);
 $customer = $result->fetch_assoc() ; 
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
                <div class=" px-[2.5rem] my-[2rem] flex gap-[10px] items-center ">
                    <h3 class="text-center text-[1.25rem] font-semibold text-violet-500"> Accounts Of Customer  : </h3>
                    <div class="flex gap-[5px] text-gray-500">
                        <h3 class="text-center text-[1.25rem] font-semibold"> <?php echo $customer["firstName"] ?> </h3>
                        <h3 class="text-center text-[1.25rem] font-semibold "> <?php echo $customer["familyName"] ?> </h3>
                    </div>
                </div>
                <table class="w-[92.5%] mx-auto border-2 border-gray-300 font-semibold text-[0.9rem]">
                    <tr class="w-full text-violet-600 ">
                        <td class="border-2 border-gray-300 p-[0.4rem]">ID</td>
                        <td class="border-2 border-gray-300 p-[0.4rem]">RIB</td>
                        <td class="border-2 border-gray-300 p-[0.4rem]">Balance</td>
                        <td class="border-2 border-gray-300 p-[0.4rem]">Currency</td>
    
                    </tr>
                    <?php
                        while( $account = $accountsPerCustomer->fetch_assoc() ){
                            echo "
                            <tr class='w-full text-gray-600'>
                                <td class='border-2 border-gray-300 p-[0.4rem]'>$account[accountId]</td>
                                <td class='border-2 border-gray-300 p-[0.4rem]'>$account[RIB]</td>
                                <td class='border-2 border-gray-300 p-[0.4rem]'>$account[balance]</td>
                                <td class='border-2 border-gray-300 p-[0.4rem]'>$account[currency]</td>
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
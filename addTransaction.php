<?php
include("dbConnection.php");


$bringTransactionDatas = "select account.RIB, account.accountId, customer.familyName FROM account JOIN customer ON customer.customerId = account.customerId;";
$datas = $cnx->query($bringTransactionDatas);

if($_SERVER["REQUEST_METHOD"] == "POST"){

   $wage = $_POST["wage"];
   $type = $_POST["type"];
   $accountId = $_POST["account"];

   
   $addTransactionQuery = "insert into transaction(wage,type,accountId) values (?,?,?)";
   $stmt = $cnx->prepare($addTransactionQuery);
   $stmt->bind_param("dsi",$wage,$type,$accountId);

   try {
     $stmt->execute();
     include("redirectUser.php");
     redirect("accounts.php",false);
   }
   catch(Exception $e) {
      die ("invalid query ! " . $e->getMessage());
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
                <h3 class="text-center text-[1.25rem] font-semibold text-violet-500">Add transaction Form:</h3>
                </div>
                
            </div>
            <form method="POST" class="w-[40%] mx-auto">
                <div class="flex flex-col gap-[7px]">
                    <label for="wage"> Wage :</label>
                    <input type="text" name="wage" class="focus:outline-none bg-violet-200 font-semibold rounded-lg p-[0.4rem]">
                    
                </div>

                <div class="flex flex-col gap-[7px]">
                    <label for="type">Type :</label>
                    <select name="type" class="focus:outline-none bg-violet-200 font-semibold rounded-lg p-[0.4rem]">
                        <option value="select account's owner">select transaction </option>
                        <option value="debit">Debit</option>
                        <option value="credit">Credit</option>
                    </select>
                </div>

                <div class="flex flex-col gap-[7px]">
                    <label for="account">Account's RIB :</label>
                    <select name="account" class="focus:outline-none bg-violet-200 font-semibold rounded-lg p-[0.4rem]">
                        <option value="select RIB"> select RIB</option>


                       <?php
                         
                            
                            while($data = $datas->fetch_assoc()){
                              echo "
                                <option value='$data[accountId]'>$data[RIB] : $data[familyName]</option>
                              ";
                            }
                       
                      

                       ?>



                    </select>
                </div>
             
               

                <input type="submit" value="Submit Data" class="w-[25%] h-[2rem] bg-violet-500 mx-[37.5%] text-white rounded-sm mt-[2rem] cursor-pointer">
 </form>
    
    
        </main>
    </div>    
    
    
</body>
</html>

<?php
    
    include("dbConnection.php");


    // $createDbQuery = "create database db_mini_bank_app";

    // if(!$cnx->query($createDbQuery)){
    //     die("invalid query" . $cnx->error );
    // }


    // $createCustomerTableQuery = "
    //     CREATE TABLE customer (
    //         customerId int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    //         firstName VARCHAR(50),
    //         familyName VARCHAR(50),
    //         birthday date,
    //         nationality VARCHAR(50),
    //         gendre VARCHAR(30)
    //     )
    // " ;

    // if(!$cnx->query($createCustomerTableQuery)){
    //    die ("invalid query" . $cnx->error);
    // }

    // $createAccountTableQuery = "
    //     create table account (
    //         accountId int NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    //         balance int ,
    //         currency VARCHAR(10)
    //     )
    
    // ";

    // if(!$cnx->query($createAccountTableQuery)){
    //   die("invalid query <br>" . $cnx->error);
    // }

    



    // $createTransactionTable = "
    // create TABLE transaction (
    //     transactionId int NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    //     wage float,
    //     type VARCHAR(50),
    //     customerId int,
    //     FOREIGN KEY (customerId) REFERENCES customer(customerId)
        
    //  )
    // " ;

//  try {
//     $cnx->query($createTransactionTable);
//     echo "done";
//  }

//  catch (exception){
//     die("error" . $cnx->errno);
//  }


// $addForeignKeyInTransaction = "
//     alter table transaction 
//     add CONSTRAINT fk_accountId
//     FOREIGN KEY (accountId) References account(accountId)
// ";

// $addForeignKeyInAccount = "
//     alter table account 
//     add CONSTRAINT fk_customerId
//     FOREIGN KEY (customerId) References customer(customerId)
// ";

// try{
//     $cnx->query($addForeignKeyInAccount);
//     echo "fish";
// }

// catch (e){
//    die("invalid query" . $cnx->error);
// }


// $insertCustomersQuery = "insert into customer(firstName,familyName,birthday,nationality,gendre) VALUES ('mohamed','joual',03/01/2001,'moroccan','male')";
// $insertCustomersQuery2 = "insert into customer(firstName,familyName,birthday,nationality,gendre) VALUES ('moha','moha',2001-03-01,'moroccan','male')";

// try{
//     $cnx->query($insertCustomersQuery2);
//     echo "fish";
// }

// catch (e){
//    die("invalid query" . $cnx->error);
// }


$selectAllCustomersQuery = "select * from customer";
$customers = $cnx->query($selectAllCustomersQuery);



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
                <h3 class="text-center text-[1.25rem] font-semibold text-violet-500">Clients Dashboard :</h3>
                <a href="addCustomer.php"class="px-[0.4rem] py-[0.3rem] bg-violet-500 text-white">Add New Client</a>
                </div>
                <table class="w-[92.5%] mx-auto border-2 border-gray-300 font-semibold text-[0.9rem]">
                    <tr class="w-full text-violet-600 ">
                        <td class="border-2 border-gray-300 p-[0.4rem]">ID</td>
                        <td class="border-2 border-gray-300 p-[0.4rem]">FIRST NAME</td>
                        <td class="border-2 border-gray-300 p-[0.4rem]">FAMILY NAME</td>
                        <td class="border-2 border-gray-300 p-[0.4rem]">BIRTHDAY</td>
                        <td class="border-2 border-gray-300 p-[0.4rem]">NATIONALITY</td>
                        <td class="border-2 border-gray-300 p-[0.4rem]">GENDRE</td>
                        <td class="border-2 border-gray-300 p-[0.4rem]">ACTIONS</td>
                    </tr>
                    <?php
                    
                    while($customer = $customers->fetch_assoc()){
                        try {
                            echo "
                                <tr class='w-full'>
                                    <td class='border-2 border-gray-300 p-[0.4rem]'>$customer[customerId]</td>
                                    <td class='border-2 border-gray-300 p-[0.4rem]'>$customer[firstName]</td>
                                    <td class='border-2 border-gray-300 p-[0.4rem]'>$customer[familyName]</td>
                                    <td class='border-2 border-gray-300 p-[0.4rem]'>$customer[birthday]</td>
                                    <td class='border-2 border-gray-300 p-[0.4rem]'>$customer[nationality]</td>
                                    <td class='border-2 border-gray-300 p-[0.4rem]'>$customer[gendre]</td>
                                    <td class='border-2 border-gray-300 p-[0.4rem]'>
                                        <a href='editCustomer.php?id=$customer[customerId]' class='px-[0.4rem] py-[0.2rem] bg-black text-white'>Edit</a>
                                        <a href='deleteCustomer.php?id=$customer[customerId]' class='px-[0.4rem] py-[0.2rem] bg-red-600 text-white'>Delete</a>
                                        <a href='accountsOfCustomer.php?id=$customer[customerId]' class='px-[0.4rem] py-[0.2rem] bg-gray-300 text-white'>see Accounts</a>
                                    </td>
                                </tr>
                            ";
                        }

                        catch(e){
                            die("invalid query");
                        }
                    
                    }
                    
                    ?>
                </table>
            </div>
        
    
        </main>
    </div>    
    
    
</body>
</html>
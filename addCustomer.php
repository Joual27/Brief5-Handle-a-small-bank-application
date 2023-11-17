<?php


include("dbConnection.php");

 


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $firstName = $_POST["firstName"];
    $familyName = $_POST["familyName"];
    $birthday = $_POST["birthday"];
    $nationality = $_POST["nationality"];
    $gender = $_POST["gender"];

    $errorMsg = "";

    if(empty($firstName) || empty($familyName) || empty($birthday) || empty($nationality) || empty($gender) ){
        $errorMsg = "All Fields are required";
    }

    else{
        $addCustomerQuery = "insert into customer (firstName,familyName,birthday,nationality,gendre) VALUES (?,?,?,?,?)";

        $stmt = $cnx->prepare($addCustomerQuery);
        $stmt->bind_param("sssss",$firstName,$familyName,$birthday,$nationality,$gender);
        
        
        try{
            $stmt->execute();
            $errorMsg = "Customer added succesfully !";
            include("redirectUser.php");
            redirect("addAccount.php",false);
           
        }
        catch(Exception $e){
            die("ERROR " . $e->getMessage());
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
                <h3 class="text-center text-[1.25rem] font-semibold text-violet-500">Add Customer Form:</h3>
                </div>
                
            </div>
            <form method="POST" class="w-[40%] mx-auto">
                <div class="flex flex-col gap-[7px]">
                    <label for="firstName"> First Name :</label>
                    <input type="text" name="firstName" class="focus:outline-none bg-violet-200 font-semibold rounded-lg p-[0.4rem]">
                    
                </div>
                <div class="flex flex-col gap-[7px]">
                    <label for="familyName">Family Name :</label>
                    <input type="text" name="familyName" class="focus:outline-none bg-violet-200 font-semibold rounded-lg p-[0.4rem]">
                </div>
                <div class="flex flex-col gap-[7px]">
                    <label for="birthday">Birthday :</label>
                    <input type="date" name="birthday" class="focus:outline-none bg-violet-200 font-semibold rounded-lg p-[0.4rem]">
                    
                </div>
                <div class="flex flex-col gap-[7px]">
                    <label for="nationality">Nationality</label>
                    <input type="text" name="nationality" class="focus:outline-none bg-violet-200 font-semibold rounded-lg p-[0.4rem]">
                   
                </div>
                <div class="flex flex-col gap-[7px]">
                    <label for="gender">Gender</label>
                    <select name="gender" id="" class="focus:outline-none bg-violet-200 font-semibold rounded-lg p-[0.4rem]">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">other</option>
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
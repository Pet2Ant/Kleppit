
<?php

//checking connection
if (isset($_POST["submit"])) {
    
    //getting the user data
    $username = $_POST["emailorusername"];
    $pwd = $_POST["pwd"];
    include "databasecon\dbcon.php";
    include "login\loginquery.php";
    include "login\loginerror.php";
    



    $login = new LoginEr($username, $pwd);
    //errors
    $login->loginUser();
    header('location:public/index.php');
} 
     
?>

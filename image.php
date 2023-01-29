<?php
session_start();
include "databasecon/dbcon.php";
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["imageName"]);
$uploadSuccess = 1;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $image = $_FILES["image"];
    $name = $_FILES["image"]["name"];
    $tmpname = $_FILES["file"]["tmp_name"];
    $fileSize = $_FILES["file"]["size"];
    $fileError = $_FILES['files']['error'];
    $check = getimagesize($tmpname);
    if($check != false)
    {
        

    }

    
}

?>
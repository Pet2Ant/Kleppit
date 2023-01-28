<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $image = $_FILES["image"];
    $name = $_FILES["image"]["name"];
    $tmpname = $_FILES["file"]["tmp_name"];
    $fileSize = $_FILES["file"]["size"];
    $fileError = $_FILES['files']['error'];
    
}

?>
<?php
session_start();
$uploaddir = 'avatars/';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "databasecon/dbcon.php";
    include "profile/profileinfo.php";
    include "profile/profilecontr.php";
    include "profile/profileview.php";

    $propfp = new ProfileInfoView();
    $id = $_SESSION["id"];
    $imageFileType = $_FILES['userfile']['type'];
    $imagefilesize = $_FILES['userfile']['size'];
    $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
    if (
        ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg"
        || $imageFileType == "gif") && ($imagefilesize < 5000000)
    ) {
        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {

            $propfp->updateAvatar($id, $_FILES['userfile']['name']);
            header('location:public/profile.php');

        }
    }
    else
    {
        echo "error";
        exit();
    }

    
    
}
?>

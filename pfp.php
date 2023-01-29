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
    echo $imageFileType;
    $imagefilesize = $_FILES['userfile']['size'];
    echo $imagefilesize;
    $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
    if (
        ($imageFileType == "image/jpg" || $imageFileType == "image/png" || $imageFileType == "image/jpeg"
        || $imageFileType == "image/gif") && ($imagefilesize < 5000000) &&( $imagefilesize > 0)
    ) {
        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {

            $propfp->updateAvatar($id, $_FILES['userfile']['name']);
            header('location:public/profile.php');

        }
    }
    else
    {
        header('location:public/profile.php');
    }

    
    
}
?>

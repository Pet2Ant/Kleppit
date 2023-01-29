<?php
session_start();
$uploaddir = 'uploads/';

if($_SERVER["REQUEST_METHOD"] == "POST") 
{
    include "databasecon/dbcon.php";
    include "post/postsql.php";
    include "post/postcont.php";
    include "post/postview.php";
    $id = $_SESSION["id"];
    $post_title = htmlspecialchars($_POST["title"], ENT_QUOTES, 'UTF-8');
    $post_content = htmlspecialchars($_POST["content"], ENT_QUOTES, 'UTF-8');
    
    if ($post_content!= null && $post_title!=null && $_FILES['userfile']['size'] == 0) {
        
        $postInfo = new PostInfoView();
        $post = new PostContr($post_title, $post_content, $id);
        $post->newPostTxt();
        header('location:public/profile.php');

    }elseif($post_content == null && $post_title != null && $_FILES['userfile']['size'] > 0)
     {
        $imageFileType = $_FILES['userfile']['type'];
        $imagefilesize = $_FILES['userfile']['size'];
        $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
        if (($imageFileType = "jpg" || $imageFileType = "png" ||$imageFileType = "jpeg" 
        || $imageFileType = "gif") &&($imagefilesize < 5000000))
         {
           

            if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
                $post = new PostContr($post_title, $_FILES['userfile']['name'], $id);
                $post->newPostImage();
                header('location:public/profile.php');

            }
        }
    }elseif($post_content != null && $post_title != null && $_FILES['userfile']['size'] > 0  )
    {   
        $imageFileType = $_FILES['userfile']['type'];
        $imagefilesize = $_FILES['userfile']['size'];
        $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
        $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
        if (
            ($imageFileType = "jpg" || $imageFileType = "png" || $imageFileType = "jpeg"
                || $imageFileType = "gif") && ($imagefilesize < 5000000)) {
            if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
                $post = new PostContr($post_title, $_FILES['userfile']['name'], $id);
                $post->newPostImage();
                header('location:public/profile.php');
            }
        }
    }elseif($post_content == null && $post_title == null && $_FILES['userfile']['size'] == 0) {
        echo "sad trumpet noises";
    }
}
?>

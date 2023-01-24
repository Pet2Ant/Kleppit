<?php
session_start();


if($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $id = $_SESSION["id"];
    $post_title = htmlspecialchars($_POST["title"], ENT_QUOTES, 'UTF-8');
    $post_content = htmlspecialchars($_POST["content"], ENT_QUOTES, 'UTF-8');
    include "databasecon/dbcon.php";
    include "post/postsql.php";
    include "post/postcont.php";
    include "post/postview.php";
    $postInfo = new PostInfoView();
    $post = new PostContr($post_title, $post_content, $id);
    $post->newPost();
   
    header('location:public/profile.php');
   
}
?>

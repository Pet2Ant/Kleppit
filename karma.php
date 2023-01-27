<?php
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") 
{
include "databasecon/dbcon.php";
include "post/postsql.php";
include "post/postcont.php";
include "post/postview.php";
include "post/indexpost.php";

$id = $_SESSION["id"];
$postkarma = new PostInfoView();
$postd = new PostInfo();



    if(isset($_POST["upvote"]))
    {
        $post_id = htmlspecialchars($_POST["post_upvote"], ENT_QUOTES, 'UTF-8');
        echo $post_id."<br>". $id;
        $postkarma->upvoteCount($post_id,$id);
        $postkarma->updateKarma($post_id,$id);

    
    }
    if(isset($_POST["downvote"]))
    {
       
        $post_id = htmlspecialchars($_POST["post_downvote"], ENT_QUOTES, 'UTF-8');
        $postkarma->downvoteCount($post_id, $id);
        $postkarma->updateKarma($post_id,$id);
    }

   
    header('location:public/index.php');
}



?>
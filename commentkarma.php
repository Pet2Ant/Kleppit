<?php
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") 
{
include "databasecon/dbcon.php";
include "post/postsql.php";
include "post/postcont.php";
include "post/postview.php";
include "post/indexpost.php";
if(!$_SESSION)
{
    header('location:public/loginform.php');
    return;
}
$id = $_SESSION["id"];
$commentkarma = new PostInfoView();
$comment = new IndexPostInfo();



    if(isset($_POST["upvote"]))
    {
        $comment_id = htmlspecialchars($_POST["c_upvote"], ENT_QUOTES, 'UTF-8');
        
        
        $commentkarma->upvotesCount($comment_id,$id);     
        $commentkarma->updatesKarma($comment_id);
        $post_id = $commentkarma->getPostIdFromCommentId($comment_id);
        $post_id = $post_id[0]["post_id"];
    }
    elseif(isset($_POST["downvote"]))
    {
       
        $comment_id = htmlspecialchars($_POST["c_downvote"], ENT_QUOTES, 'UTF-8');
       
        $commentkarma->downvotesCount($comment_id, $id);
        $commentkarma->updatesKarma($comment_id);
        $post_id = $commentkarma->getPostIdFromCommentId($comment_id);
        $post_id = $post_id[0]["post_id"];
       
    }else
    {
        echo "invalid option";
        exit();
    }
    
    header("location:public/ProfileComments.php?p=$post_id");
    
}



?>
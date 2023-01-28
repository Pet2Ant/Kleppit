<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
$postkarma = new PostInfoView();
$post_id = $_POST["post_id"];
$text = $_POST["comment"];
    if ($text != null) {
        $postkarma->createComment($id, $post_id, $text);
        header("location:public/page.php?p=".$post_id);
    }else
    {
        header("location:public/page.php?p=".$post_id);
    }




}
?>
<?php

class PostInfo extends DbCon
{

    protected function getUserInfo($id)
    {
        $stmt = $this -> connect()->prepare('SELECT * FROM post where users_id= ?;');
        if(!$stmt->execute(array($id)))
        {
            $stmt = null;
            header('location: post.php?error=stmtfailed');
            exit();
        }
        if($stmt->rowCount() == 0)
        {
            $stmt = null;
            // header('location: profile.php?error=profilenotfound');
            // exit();
        }

        $profileData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $profileData;

    }
    protected function getUser($id)
    {
        $stmt = $this -> connect()->prepare('SELECT * FROM users where id= ?;');
        if(!$stmt->execute(array($id)))
        {
            $stmt = null;
            header('location: post.php?error=stmtfailed');
            exit();
        }
        if($stmt->rowCount() == 0)
        {
            $stmt = null;
            // header('location: profile.php?error=profilenotfound');
            // exit();
        }

        $profileData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $profileData;

    }

    protected function getPostId($id)
    {
        $stmt = $this -> connect()->prepare('SELECT post_id FROM post where users_id= ?;');
        if(!$stmt->execute(array($id)))
        {
            $stmt = null;
            header('location: post.php?error=stmtfailed');
            exit();
        }
        if($stmt->rowCount() == 0)
        {
            $stmt = null;
            // header('location: profile.php?error=profilenotfound');
            // exit();
        }
        $count = 0;
        while($count<=$stmt->rowCount())
        {
            $count++;
        }

        // $post_id = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // return $post_id;
        return $count;

    }
    protected function updatePost($post_title,$post_content,$id)
    {
        $stmt = $this -> connect()->prepare('UPDATE  post SET post_title=? 
        ,post_content= ? WHERE users_id=?;');
        if(!$stmt->execute(array($post_title,$post_content,$id)))
        {
            $stmt = null;
            header('location: post.php?error=stmtfailed');
            exit();
        }
               

        $stmt = null;
    }
    protected function createPost($post_title,$post_content,$id)
    {
        $stmt = $this -> connect()->prepare('INSERT INTO  post (post_title, 
        post_content,users_id) VALUES (?,?,?) ;');
        
        if(!$stmt->execute(array($post_title,$post_content,$id)))
        {
            $stmt = null;
            header('location: post.php?error=stmtfailed');
            exit();
        }

        $stmt = null;
    }
    
    // protected function deletePost($id)
    // {

    // }

}
?>
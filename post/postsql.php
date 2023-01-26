<?php

class PostInfo extends DbCon
{

    protected function getPostInfo($id)
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
            header('location: profile.php?error=profilenotfound');
            exit();
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
            header('location: profile.php?error=profilenotfound');
            exit();
        }

        $profileData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $profileData;

    }
    
    protected function postRows()
    {
        $stmt = $this->connect()->prepare('SELECT * FROM users u inner join post p on p.users_id  = u.id ;' );
        $stmt->execute();
        if ($stmt->rowCount() == 0) 
        {
            $stmt = null;
        }
       
        $result = $stmt->fetchAll();
        return $result;
        
        
    }
    protected function getSpecPostId($id)
    {
        $stmt = $this->connect()->prepare('SELECT post_id FROM post where users_id= ?;');
        if (!$stmt->execute(array($id))) {
            $stmt = null;
            
            header('location: post.php?error=stmtfailed');
            exit();
        }
        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header('location: profile.php?error=profilenotfound');
            exit();
        }
        $post_id = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $post_id;
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
            header('location: profile.php?error=profilenotfound');
            exit();
        }
        $count = 0;
        while($count<=$stmt->rowCount())
        {
            $count++;
        }

    
        return $count;

    }
    protected function updatePost($post_title,$post_content,$id)
    {
        $stmt = $this -> connect()->prepare('UPDATE  post SET  
        post_content= ? WHERE users_id=?;');
        if(!$stmt->execute(array($post_content,$id)))
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
        post_content,users_id,post_upvote,post_downvote,post_karma) VALUES (?,?,?,0,0,0) ;');
        
        if(!$stmt->execute(array($post_title,$post_content,$id)))
        {
            $stmt = null;
            header('location: post.php?error=stmtfailed');
            exit();
        }

        $stmt = null;
        
        
    }
    protected function fetchAllPosts()
    {
        $stmt = $this -> connect()->prepare('SELECT post_id FROM post ');
        if(!$stmt->execute(array()))
        {
            $stmt = null;
            header('location: post.php?error=stmtfailed');
            exit();
        }
        if($stmt->rowCount() == 0)
        {
            $stmt = null;
           echo "gamieme";
            exit();
        }
        $count = 0;
        while($count<=$stmt->rowCount())
        {
            $count++;
        }

    
        return $count;
    
    }
  
    
    
   
    
    protected function upvote($upvote,$post_id,$id)
    {
        $stmt = $this -> connect()->prepare('UPDATE  post SET  
        post_upvote = ?, votecap = 1  WHERE post_id=?  AND users_id=? ;');
        if(!$stmt->execute(array($upvote,$post_id,$id)))
        {
            $stmt = null;
            header('location: post.php?error=stmtfailed');
            exit();
        }
        $stmt = null;
    }
    protected function downvote($downvote,$post_id,$id)
    {
        $stmt = $this -> connect()->prepare('UPDATE  post SET post_downvote = ?,votecap = -1 
        WHERE post_id=? AND users_id=?');
        if(!$stmt->execute(array($downvote,$post_id,$id)))
        {
            $stmt = null;
            header('location: post.php?error=stmtfailed');
            exit();
        }
        $stmt = null;
    }
    protected function getVotecap($post_id,$id)
    {
        $stmt = $this -> connect()->prepare('SELECT votecap FROM post where post_id= ? AND users_id=? ;');
        if(!$stmt->execute(array($post_id,$id)))
        {
            $stmt = null;
            header('location: post.php?error=stmtfailed');
            exit();
        }
        $votecap = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $votecap;
    }
    protected function upvotes($post_id,$id)
    {   $stmt1 = $this -> connect()->prepare('SELECT post_upvote FROM post where post_id= ? ;');
        // if(!$stmt1->execute(array($post_id,$id)))
        // {
        //     $stmt1 = null;
        //     header('location: post.php?error=stmtfailed');
        //     exit();
        // }
        $upvotes = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        return $upvotes;
    }
    protected function downvotes($post_id,$id)
    {
        $stmt2 = $this -> connect()->prepare('SELECT post_downvote FROM post where post_id= ? ;');
        // if(!$stmt2->execute(array($post_id,$id)))
        // {
        //     $stmt2 = null;
        //     header('location: post.php?error=stmtfailed');
        //     exit();
        // }
         $downvotes = $stmt2->fetchAll(PDO::FETCH_ASSOC);
         return $downvotes;
    }
        
    protected function Karma($karma,$post_id,$id)
    {
        $stmt3 = $this -> connect()->prepare('UPDATE  post SET post_karma=?
                WHERE post_id=?  AND users_id=?;');
    
        if(!$stmt3->execute(array($karma,$post_id,$id)))
        {
            $stmt3= null;
            header('location: post.php?error=stmtfailed');
            exit();
        }
    }
   
       
        
        
    
    
    // protected function deletePost($id)
    // {

    // }

}
?>
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
    //search function
    protected function searchQuery($search)
    {
        $stmt = $this->connect()->prepare("SELECT post_id FROM post WHERE post_title LIKE '%$search%' OR post_content LIKE '%$search%';");
        if(!$stmt->execute(array($search)))
        {
            $stmt = null;
            header('location: post.php?error=stmtfailed');
            exit();
        }
        if($stmt->rowCount() == 0)
        {
            $stmt = null;
            // nothing found during the search
            header('location: profile.php?error=profilenotfound');
            exit();
        }
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    protected function postRows()
    {
        $stmt = $this->connect()->prepare('SELECT * FROM users u inner join post p on p.users_id  = u.id  ;' );
        $stmt->execute();
        if ($stmt->rowCount() == 0) 
        {
            $stmt = null;
        }
       
        $result = $stmt->fetchAll();
        return $result;
    }
    protected function postRowsKarmaAsc()
    {
        $stmt = $this->connect()->prepare('SELECT * FROM users u inner join post p on p.users_id = u.id ORDER BY p.post_karma ASC;' );
        $stmt->execute();
        if ($stmt->rowCount() == 0) 
        {
            $stmt = null;
        }
       
        $result = $stmt->fetchAll();
        return $result;
    }
    protected function postRowsKarmaDesc()
    {
        $stmt = $this->connect()->prepare('SELECT * FROM users u inner join post p on p.users_id = u.id ORDER BY post_karma DESC' );
        $stmt->execute();
        if ($stmt->rowCount() == 0) 
        {
            $stmt = null;
        }
       
        $result = $stmt->fetchAll();
        return $result;
    }
    protected function postRowsSortNewest()
    {
        $stmt = $this->connect()->prepare('SELECT * FROM users u inner join post p on p.users_id = u.id ORDER BY post_id ASC' );
        $stmt->execute();
        if ($stmt->rowCount() == 0) 
        {
            $stmt = null;
        }
       
        $result = $stmt->fetchAll();
        return $result;
    }
    protected function postRowsSortOldest()
    {
        $stmt = $this->connect()->prepare('SELECT * FROM users u inner join post p on p.users_id = u.id ORDER BY post_id DESC' );
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
  
    
    
   
    
    protected function upvote($upvote,$post_id)
    {
        $stmt = $this -> connect()->prepare('UPDATE  post SET  
        post_upvote = ? WHERE post_id=?  ;');
        if(!$stmt->execute(array($upvote,$post_id)))
        {
            $stmt = null;
            header('location: post.php?error=stmtfailed');
            exit();
        }
        $stmt = null;
    }
    
    protected function downvote($downvote,$post_id)
    {
        $stmt = $this -> connect()->prepare('UPDATE  post SET post_downvote = ?
        WHERE post_id=? ');
        if(!$stmt->execute(array($downvote,$post_id)))
        {
            $stmt = null;
            header('location: post.php?error=stmtfailed');
            exit();
        }
        $stmt = null;
    }
    protected function updateVotecapPos($post_id,$users_id)
    {
        $stmt = $this -> connect()->prepare('UPDATE  pkarma SET votecap = 1 
        WHERE post_id=? AND users_id=?');
        if(!$stmt->execute(array($post_id,$users_id)))
        {
            $stmt = null;
            header('location: post.php?error=stmtfailed');
            exit();
        }
        $stmt = null;
    }
    protected function updateVotecapNeg($post_id,$users_id)
    {
        $stmt = $this -> connect()->prepare('UPDATE  pkarma SET votecap =-1 
        WHERE post_id=? AND users_id=?');
        if(!$stmt->execute(array($post_id,$users_id)))
        {
            $stmt = null;
            header('location: post.php?error=stmtfailed');
            exit();
        }
        $stmt = null;
    }
    
    protected function getVotecap($post_id,$id)
    {
        $stmt = $this -> connect()->prepare('SELECT votecap FROM pkarma where post_id= ? AND users_id=? ;');
        if(!$stmt->execute(array($post_id,$id)))
        {
            $stmt = null;
            header('location: post.php?error=stmtfailed');
            exit();
        }
        $votecap = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $votecap;
    }
    // protected function createVotecap($post_id,$id)
    // {   
    //     $stmt1 = $this -> connect()->prepare('SELECT id from users');
    //     if(!$stmt1->execute())
    //     {
    //         $stmt = null;
    //         header('location: post.php?error=nousersindb');
    //         exit();
    //     }
        
    //     $count = 0;
    //     while($count < $stmt1->rowCount() )
    //     {
    //         $count = $count++;
    //     }
    //     $users = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        
    //     $stmt = $this -> connect()->prepare('INSERT INTO pkarma (users_id,post_id,votecap) values (');
    // }
    protected function upvotes($post_id)
    {   $stmt1 = $this -> connect()->prepare('SELECT post_upvote FROM post where post_id= ? ;');
        if(!$stmt1->execute(array($post_id)))
        {
            $stmt1 = null;
            header('location: post.php?error=stmtfailed');
            exit();
        }
        $upvotes = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        return $upvotes;
    }
    protected function downvotes($post_id)
    {
        $stmt2 = $this -> connect()->prepare('SELECT post_downvote FROM post where post_id= ? ;');
        if(!$stmt2->execute(array($post_id)))
        {
            $stmt2 = null;
            header('location: post.php?error=stmtfailed');
            exit();
        }
         $downvotes = $stmt2->fetchAll(PDO::FETCH_ASSOC);
         return $downvotes;
    }
        
    protected function Karma($karma,$post_id)
    {
        $stmt3 = $this -> connect()->prepare('UPDATE  post SET post_karma=?
                WHERE post_id=? ;');
    
        if(!$stmt3->execute(array($karma,$post_id)))
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
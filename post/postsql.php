<?php

class PostInfo extends DbCon
{

    protected function getUserPosts($id)
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

    public function getUserByName($username)
    {
        $stmt = $this -> connect()->prepare('SELECT * FROM users where username = ?;');
        if(!$stmt->execute(array($username)))
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

    protected function getPost($postid)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM post p INNER JOIN users u ON u.id = p.users_id WHERE post_id=?');
        if(!$stmt->execute(array($postid)))
        {
            $stmt =null;
        }
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //Check if array key 0 is undefined
        if(!isset($result[0]))
        {
            $stmt = null;
            return null;
        }

        $result = $result[0];
        //debug
        // print_r($result);
        // exit();
        return $result;
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
            return -1;
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

    protected function getPostCount($id)
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

    protected function fetchAllPosts($user)
    {

        $SQLstatement = "SELECT post_id FROM post";
        $SQLarry = array();
        if ($user && $user != -1) {
            $SQLstatement .= " WHERE users_id = ?";
            $SQLarry = array($user);
        }

        $stmt = $this -> connect()->prepare($SQLstatement);
        if(!$stmt->execute($SQLarry))
        {
            $stmt = null;
            header('location: post.php?error=stmtfailed');
            exit();
        }
        if($stmt->rowCount() == 0)
        {
            $stmt = null;
            echo "<br><br><h2 class='text-red-500'>No posts found</h2>";
            return 0;
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
        if(!$votecap)
        {
            return false;
        }
        
        return $votecap[0];
    }

    protected function createVotecap($id,$post_id,$votecap)
    {
        try {
            $stmt = $this->connect()->prepare('INSERT INTO pkarma (post_id,users_id,votecap,pkarma_id) VALUES(?,?,?,?);');
            if(!$stmt->execute(array($post_id, $id, $votecap,"".$post_id."".$id.""))) {
                $stmt = null;
                header('location: post.php?error=stmtfailed');
                exit();
            }

        }catch(PDOException $e){
            error_log($e);
            $stmt = null;
        }
        

    }
    protected function deleteVotecap($id,$post_id)
    {
        $stmt = $this -> connect()->prepare('DELETE  FROM pkarma WHERE users_id=? AND post_id=? ');
        if(!$stmt->execute(array($id,$post_id)))
        {
            $stmt = null;
            header('location: post.php?error=stmtfailed');
            exit();
        }
        return;
    }
    protected function setupVotes()
    {

    }
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
    protected function createCommmentDb($users_id,$post_id,$text)
    {
        $sql =('INSERT INTO post_comments 
        (users_id,post_id,text,c_upvote,c_downvote,c_karma)
        VALUES(?,?,?,0,0,0);');
        $stmt = $this->connect()->prepare($sql);
        if(!$stmt->execute(array($users_id,$post_id,$text)))
        {
            $stmt= null;
            header('location: post.php?error=stmtfailed');
            exit();
        }
    }
    protected function getsPostIdFromCommentId($id)
    {
        $SQL =('SELECT post_id FROM post_comments  where id = ?');
        $stmt = $this->connect()->prepare($SQL);
        if(!$stmt->execute(array($id)))    
        {
            $stmt= null;
            header('location: post.php?error=stmtfailed');
            exit();
        }
        
        $result = $stmt->fetchAll();
       
        return $result;
    }
    protected function fetchCommentDb($post_id)
    {
        $SQL = ('SELECT * FROM post_comments p INNER JOIN  users u on u.id = p.users_id where post_id = ?');
        $stmt = $this->connect()->prepare($SQL);
        if(!$stmt->execute(array($post_id)))    
        {
            $stmt= null;
            header('location: post.php?error=stmtfailed');
            exit();
        }
        $result = $stmt->fetchAll();
        return $result;
    }
    protected function fetchUserCommentDb($users_id)
    {
        $SQL = ('SELECT * FROM post_comments p INNER JOIN  users u on u.id = p.users_id where  users_id=?');
        $stmt = $this->connect()->prepare($SQL);
        if(!$stmt->execute(array($users_id)))
        {
            $stmt= null;
            header('location: post.php?error=stmtfailed');
            exit();
        }
        $result = $stmt->fetchAll();
        return $result;
    }
    protected function cupvote($upvote,$id)
    {
        $stmt = $this -> connect()->prepare('UPDATE post_comments SET  
        c_upvote = ? WHERE id=?  ;');
        if(!$stmt->execute(array($upvote,$id)))
        {
            $stmt = null;
            header('location: post.php?error=stmtfailed');
            exit();
        }
        $stmt = null;
    }
    
    protected function cdownvote($downvote,$id)
    {
        $stmt = $this -> connect()->prepare('UPDATE post_comments  SET c_downvote = ?
        WHERE id=? ');
        if(!$stmt->execute(array($downvote,$id)))
        {
            $stmt = null;
            header('location: post.php?error=stmtfailed');
            exit();
        }
        $stmt = null;
    }
    protected function cupdateVotecapPos($c_id,$users_id)
    {
        $stmt = $this -> connect()->prepare('UPDATE  ckarma SET votecap = 1 
        WHERE c_id=? AND users_id=?');
        if(!$stmt->execute(array($c_id,$users_id)))
        {
            $stmt = null;
            header('location: post.php?error=stmtfailed');
            exit();
        }
        $stmt = null;
    }
    protected function cupdateVotecapNeg($c_id,$users_id)
    {
        $stmt = $this -> connect()->prepare('UPDATE  ckarma SET votecap =-1 
        WHERE c_id=? AND users_id=?');
        if(!$stmt->execute(array($c_id,$users_id)))
        {
            $stmt = null;
            header('location: post.php?error=stmtfailed');
            exit();
        }
        $stmt = null;
    }
    
    protected function getVotecapC($c_id,$id)
    {
        $stmt = $this -> connect()->prepare('SELECT votecap FROM ckarma where c_id= ? AND users_id=? ;');
        if(!$stmt->execute(array($c_id,$id)))
        {
            $stmt = null;
            header('location: post.php?error=stmtfailed');
            exit();
        }
        $votecap = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(!$votecap)
        {
            return false;
        }
        
        return $votecap[0];
    }

    protected function createVotecapC($id,$c_id,$votecap)
    {
        try {
            $stmt = $this->connect()->prepare('INSERT INTO ckarma (users_id,c_id,ckarma_id,votecap) VALUES(?,?,?,?);');
            if(!$stmt->execute(array($id,$c_id, "".$c_id."".$id."",$votecap))) {
                $stmt = null;
                header('location: post.php?error=stmtfailed');
                exit();
            }

        }catch(PDOException $e){
            error_log($e);
            $stmt = null;
        }
        

    }
    protected function deleteVotecapC($id,$c_id)
    {
        $stmt = $this -> connect()->prepare('DELETE  FROM ckarma WHERE users_id=? AND c_id=? ');
        if(!$stmt->execute(array($id,$c_id)))
        {
            $stmt = null;
            header('location: post.php?error=stmtfailed');
            exit();
        }
        return;
    }
    
    protected function upvotesC($c_id)
    {   $stmt1 = $this -> connect()->prepare('SELECT c_upvote FROM post_comments where id= ? ;');
        if(!$stmt1->execute(array($c_id)))
        {
            $stmt1 = null;
            header('location: post.php?error=stmtfailed');
            exit();
        }
        $upvotes = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        
        return $upvotes;
    }
    protected function downvotesC($c_id)
    {
        $stmt2 = $this -> connect()->prepare('SELECT c_downvote FROM post_comments where id= ? ;');
        if(!$stmt2->execute(array($c_id)))
        {
            $stmt2 = null;
            header('location: post.php?error=stmtfailed');
            exit();
        }
         $downvotes = $stmt2->fetchAll(PDO::FETCH_ASSOC);
         return $downvotes;
    }
        
    protected function KarmaC($karma,$c_id)
    {
        $stmt3 = $this -> connect()->prepare('UPDATE  post_comments SET c_karma=?
                WHERE id=? ;');
    
        if(!$stmt3->execute(array($karma,$c_id)))
        {
            $stmt3= null;
            header('location: post.php?error=stmtfailed');
            exit();
        }
    }
    public function getCommentsCountFromPost($post_id)
    {
        return $this->fetchCommentDb($post_id);
        
    }
    public function hasTakenSurvey($user_id)
    {
        $SQL = ('SELECT * FROM survey WHERE user_id=?');
        $stmt = $this->connect()->prepare($SQL);
        if(!$stmt->execute(array($user_id)))
        {
            $stmt= null;
            header('location: post.php?error=stmtfailed');
            exit();
        }
       
    }
 
    
    
    // protected function deletePost($id)
    // {

    // }

}
?>
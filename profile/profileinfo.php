<?php

class ProfileInfo extends DbCon
{

    protected function getProfileInfo($id)
    {
        $stmt = $this -> connect()->prepare('SELECT * FROM profiles where users_id= ?;');
        if(!$stmt->execute(array($id)))
        {
            $stmt = null;
            header('location: profile.php?error=stmtfailed');
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
    protected function setNewProfileInfo($profileAbout,$profileTitle,$id)
    {
        $stmt = $this -> connect()->prepare('UPDATE  profiles SET profiles_about=? 
        ,profiles_title= ? WHERE users_id=?;');
        if(!$stmt->execute(array($profileAbout,$profileTitle,$id)))
        {
            $stmt = null;
            header('location: profile.php?error=stmtfailed');
            exit();
        }
               

        $stmt = null;
    }
    protected function updatesAvatar($id,$newPfp)
    {
        $stmt = $this->connect()->prepare('UPDATE  profiles SET profile_pic=? WHERE users_id=?;');
        if(!$stmt->execute(array($newPfp,$id)))
        {
            $stmt = null;
            header('location: profile.php?error=stmtfailed');
            exit();
        }
            
        $stmt = null;
    }
    protected function getAvatar($id)
    {
        $stmt = $this -> connect()->prepare('SELECT profile_pic FROM profiles WHERE users_id=?;');
        if(!$stmt->execute(array($id)))
        {
            $stmt = null;
            header('location: profile.php?error=stmtfailed');
            exit();
        }
            
        $profileInfo = $stmt->fetchAll();
        // echo ($profileInfo)[0]['profile_pic'];
        // exit();
        return $profileInfo;
    }
    protected function setProfileInfo($profileAbout,$profileTitle,$profileimage,$id)
    {
        $stmt = $this -> connect()->prepare('INSERT INTO  profiles (profiles_about, 
        profiles_title,profiles_pic,users_id) VALUES (?,?,?) ;');
        if(!$stmt->execute(array($profileAbout,$profileTitle,$profileimage,$id)))
        {
            $stmt = null;
            header('location: profile.php?error=stmtfailed');
            exit();
        }

        $stmt = null;
    }
    protected function getUserPostKarma($id)
    {
        $sql=('SELECT SUM(post_karma) FROM post where users_id=?;' );
        $stmt = $this->connect()->prepare($sql);
       
        if (!$stmt->execute(array($id))) {
            $stmt = null;
            
            header('location: post.php?error=stmtfailed');
            exit();
        }
        $result = $stmt->fetchAll();
        return $result;
    }   
    protected function getUserCommentKarma($id)
    {
        $sql= ('SELECT SUM(c_karma) FROM post_comments where users_id=?;' );
        $stmt = $this->connect()->prepare($sql);
        
        if (!$stmt->execute(array($id))) {
            $stmt = null;
            
            header('location: post.php?error=stmtfailed');
            exit();
        }

        $result = $stmt->fetchAll();
        return $result;
    }

}
?>
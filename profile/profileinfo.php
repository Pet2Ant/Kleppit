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
    protected function setNewProfileInfo($profileAbout,$profileTitle,$profileText,$id)
    {
        $stmt = $this -> connect()->prepare('UPDATE  profiles SET profiles_about=? 
        ,profiles_title= ?,profiles_introduction=? WHERE users_id=?;');
        if(!$stmt->execute(array($profileAbout,$profileTitle,$profileText,$id)))
        {
            $stmt = null;
            header('location: profile.php?error=stmtfailed');
            exit();
        }

        $stmt = null;
    }
    protected function setProfileInfo($profileAbout,$profileTitle,$profileText,$id)
    {
        $stmt = $this -> connect()->prepare('INSERT INTO  profiles (profiles_about, 
        profiles_title,profiles_introduction,users_id) VALUES (?,?,?,?) ;');
        if(!$stmt->execute(array($profileAbout,$profileTitle,$profileText,$id)))
        {
            $stmt = null;
            header('location: profile.php?error=stmtfailed');
            exit();
        }

        $stmt = null;
    }

}
?>
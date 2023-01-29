<?php

class Survey extends DbCon
{
    public function survey($id,$fname ,$lname ,$age  ,$email,$recKleppit ,$Job ,$overallFeel)
    {
        $SQL = ('INSERT INTO survey (user_id,fname,lname,age,email,recKlep,job,comments) VALUES(?,?,?,?,?,?,?,?);');
        $stmt=$this->connect()->prepare($SQL);
        if(!$stmt->execute(array($id,$fname,$lname,$age ,$email,$recKleppit,$Job,$overallFeel)))
        {
            $stmt= null;
            header('location: post.php?error=stmtfailed');
            exit();
        }

    }
}
?>



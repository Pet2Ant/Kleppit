<?php

class DbCon
{

    protected function connect()
    {
        try{
                $username  = "Chris";
                $password = "yoloswag1234";
                $dbh = new PDO('mysql:host=localhost;dbname=athtech_forum',$username,$password);
                return $dbh;
        }catch(PDOException $e)
        {
            print "Error!: ".$e->getMessage()."<br/>";
            die();
        }
    }




}






?>
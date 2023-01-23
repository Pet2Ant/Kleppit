<?php

class DbCon
{

    protected function connect()
    {
        try{
                $username  = "antonisu";
                $password = "1234";
                $dbh = new PDO('mysql:host=localhost;dbname=kleppit',$username,$password);
                return $dbh;
        }catch(PDOException $e)
        {
            print "Error!: ".$e->getMessage()."<br/>";
            die();
        }
    }




}






?>
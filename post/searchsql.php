<?php

class SearchSQL extends DbCon {

    public function search($query)
    {
        $stmt = $this -> connect()->prepare($query);
        if(!$stmt->execute(array()))
        {
            echo "Unknown error occured";
            error_log("Error: " . $stmt->errorInfo()[2]);
            exit();
        }
        if($stmt->rowCount() == 0)
        {
            return null;
        }

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
        
    }

}
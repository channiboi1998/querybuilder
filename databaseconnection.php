<?php

class DatabaseConnection
{

    public $connection;
    private $DB_HOST = 'localhost', $DB_USER = 'root', $DB_PASS = '';

    public function connect($db_name)
    {
        $this->connection = new mysqli($this->DB_HOST, $this->DB_USER, $this->DB_PASS, $db_name);         
    }//connect closing

    public function fetch_all($query) 
    {
        
        $data = array();            
        $result = $this->connection->query($query);
        
        while($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }
        
        return $data;
    }//fetch all closing


    public function fetch_record($query)
    {
        $result = $this->connection->query($query);
        return mysqli_fetch_assoc($result);
    }


    //used to run INSERT/DELETE/UPDATE, queries that don't return a value
    //returns a value, the id of the most recently inserted record in your database
    function run_mysql_query($query)
    {
        $result = $this->connection->query($query);
        return $this->connection->insert_id;        
    }

    //returns an escaped string. EG, the string "That's crazy!" will be returned as "That\'s crazy!"
    //also helps secure your database against SQL injection
    public function escape_this_string($string)
    {         
        return $this->connection->real_escape_string($string);
    }

    
}// closing database

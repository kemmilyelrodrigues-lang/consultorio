<?php
namespace App;
use PDO;
use PDOException;

class DataBase
{
     const HOST = 'localhost';
     const USER = 'root';
     const PASSWORD = '123';
     const DBNAME = 'consultorio';
   
     private $connection;
     private $table;

     public function __construct($table = null)
         {
             $this->setConnection();
             $this->table = $table;
         }

    private function setConnection()
      {
         $this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::DBNAME,self::USER,self::PASSWORD);
         $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }

      public function execute($query, $values = null)
      {


          try 
           {
             $statement = $this->connection->prepare($query);
             $statement->execute($values);
             return $statement;
           }
           catch(PDOException $e)
           {
              die('ERROR: '.$e->getMessage().'');
           }
      }



      
      public function insert($array)
        {

           $fields = array_keys($array);
           $binds = array_pad([],count($array),'? ');
          $query = "INSERT INTO '.$this->table.'('.implode(', ',$fields).')values()";  
          values('.implode(',',$binds).');
          $this->execute($query, array_values($array));
          return $this->connection->lastInsertId();

           echo"<pre>";
           print_r($array);
           print_r($fields);
           print_r($binds);
           print_r($query);
           echo"</pre>";
        }
}   
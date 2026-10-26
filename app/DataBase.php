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
        try {
            $this->connection = new PDO(
                'mysql:host=' . self::HOST .
                ';dbname=' . self::DBNAME .
                ';charset=utf8mb4',
                self::USER,
                self::PASSWORD
            );

            $this->connection->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

        } catch (PDOException $e) {
            die('Erro ao conectar ao banco: ' . $e->getMessage());
        }
    }

    public function execute($query, $values = null)
    {
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute($values ?? []);

            return $statement;

        } catch (PDOException $e) {
            die('Erro ao executar consulta: ' . $e->getMessage());
        }
    }

    public function insert($array)
    {
        $fields = array_keys($array);
        $binds = array_fill(0, count($array), '?');

        $query = 'INSERT INTO ' . $this->table .
            ' (' . implode(', ', $fields) . ')' .
            ' VALUES (' . implode(', ', $binds) . ')';

        $this->execute($query, array_values($array));

        return $this->connection->lastInsertId();
    }

    public function select($where = null , $order = null, $limit = null)
    {
         $where = strlen($where) ? 'where'.$where : '';
         $where = strlen($where) ? 'order by'.$order : '';
         $where = strlen($where) ? 'limit'.$limit : '';

        $query = 'SELECT * FROM ' . $this->table;

        return $this->execute($query);
    }

    public function update ($array, $where)
    {
        $fields = array_keys($array);
        $binds = array_pad([],count($array),' = ?,');
        $querry = 'update'.$this->table.'set'.implode($binds,$fields) .' =?  where'.$where;
        return $this->execute($querry,array_values($array));

    }
 
     public function excluir($where)
     {
       $querry = 'DELETE FROM '.$this->table.'where'.$where;
       return $this->execute($querry);
         
     }



}

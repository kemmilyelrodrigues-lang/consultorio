
<?php

namespace App;

use PDO;

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
        $this->table = $table;
        $this->setConnection();
    }

    private function setConnection()
    {
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
    }

    public function execute($query, $values = [])
    {
        $statement = $this->connection->prepare($query);
        $statement->execute($values);

        return $statement;
    }

    public function insert($dados)
    {
        $campos = array_keys($dados);
        $marcadores = array_fill(0, count($dados), '?');

        $query = 'INSERT INTO ' . $this->table .
            ' (' . implode(', ', $campos) . ')' .
            ' VALUES (' . implode(', ', $marcadores) . ')';

        $this->execute($query, array_values($dados));

        return $this->connection->lastInsertId();
    }

    public function selectAll()
    {
        $query = 'SELECT * FROM ' . $this->table .
                 ' ORDER BY id DESC';

        return $this->execute($query)->fetchAll(
            PDO::FETCH_ASSOC
        );
    }
}

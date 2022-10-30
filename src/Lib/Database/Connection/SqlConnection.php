<?php

namespace Mts\Lib\Database\Connection;

abstract class SqlConnection
{
    public $connection;

    public abstract function connect(string $dbConnection, string $username, string $password, array $options);

    public function startConnection($dsn, $username, $password, $options)
    {
        try {
            $this->connection = new \PDO($dsn, $username, $password, $options);
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function get($query, $options)
    {
        try {
            $result = $this->connection->prepare($query);
            $result->execute($options);
            return $result->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function insert($query, $options){
        try {
            $result = $this->connection->prepare($query);
            $result->execute($options);
            return $this->connection->lastInsertId();
        } catch (\PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function execute($query, $options)
    {
        try {
            $result = $this->connection->prepare($query);
             return $result->execute($options);
        } catch (\PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function beginTransaction()
    {
        $this->connection->beginTransaction();
    }

    public function commit()
    {
        $this->connection->commit();
    }

    public function rollback()
    {
        $this->connection->rollBack();
    }


}
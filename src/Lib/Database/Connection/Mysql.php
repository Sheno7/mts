<?php


namespace Mts\Lib\Database\Connection;


class Mysql extends SqlConnection
{
    public function connect(string $database, string $username = null, string $password = null, array $options = [])
    {
        return $this->startConnection("mysql:host=127.0.1;dbname={$database}", $username, $password, $options);
    }
}
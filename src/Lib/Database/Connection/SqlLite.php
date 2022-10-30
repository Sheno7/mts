<?php

namespace Mts\Lib\Database\Connection;

class SqlLite extends SqlConnection
{
    public function connect(string $database, string $username = null, string $password = null, array $options = [])
    {
        $path = full_path($database);
        return $this->startConnection("sqlite:{$path}", $username, $password, $options);
    }
}
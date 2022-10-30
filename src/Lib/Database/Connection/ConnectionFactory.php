<?php

namespace Mts\Lib\Database\Connection;

use Mts\Lib\Database\Connection\SqlLite;

class ConnectionFactory
{
    public function getDataBase($driver){
        switch ($driver){
            case 'sqlite' : return new SqlLite();
            case 'mysql' : return new Mysql();
            default : throw new \Exception('database driver not exists');
        }
    }
}
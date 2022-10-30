<?php


namespace Mts\Lib\Database\Builder;


use Mts\Lib\Database\Connection\Connection;
use Mts\Lib\Database\Connection\SqlConnection;

class BuilderFactory
{
    public static function getBuilder($driver, SqlConnection $connection)
    {
        switch ($driver) {
            case 'sqlite' :
            case 'mysql' :
                return new SqlBuilder($connection);
            default :
                throw new \Exception('database driver not exists');
        }
    }
}
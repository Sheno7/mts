<?php


namespace Mts\Lib\Database;


use Mts\Lib\Database\Builder\BuilderFactory;

class DB
{
    public static function connection($connectionName = null)
    {
        if (!$connectionName) {
            $connectionName = config('database.default');
        }

        $connectionData = config("database.connections.$connectionName");
        $driver = $connectionData['driver'];
        $database = $connectionData['database'];
        $username = isset($connectionData['username']) ? $connectionData['username'] : null;
        $password = isset($connectionData['password']) ? $connectionData['password'] : null;
        $options = isset($connectionData['options']) ? $connectionData['options'] : [];

        if(app()->has($connectionName)){
            return BuilderFactory::getBuilder($driver,app($connectionName));
        }

        $databaseFactory = new \Mts\Lib\Database\Connection\ConnectionFactory();
        app()->bind($connectionName, $databaseFactory->getDataBase($driver))->connect($database, $username, $password, $options);
        return BuilderFactory::getBuilder($driver,app($connectionName));
    }

}
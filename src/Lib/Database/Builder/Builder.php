<?php


namespace Mts\Lib\Database\Builder;


use Mts\Lib\Database\Connection\Connection;
use Mts\Lib\Database\Connection\SqlConnection;

abstract class Builder
{
    protected $connection;
    public function __construct(SqlConnection $connection)
    {
        $this->connection=$connection;
    }

    public abstract function table($table);
     public abstract function select(...$params);
     public abstract function join($table,$id,$foreignKey,$type);
     public abstract function update();
     public abstract function delete();
     public abstract function insert($data);
     public abstract function where($key,$operator,$value,$tpe);
     public abstract function beginScope($type);
     public abstract function endScope();
}
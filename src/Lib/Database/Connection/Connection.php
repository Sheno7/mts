<?php


namespace Mts\Lib\Database\Connection;


interface Connection
{
    public function startConnection($dsn,$username,$password,$options);
}
<?php


namespace Mts\Lib\Core;


class Container
{
    protected static $instance;

    public $instances = [];

    public function has($key){
        if (isset($this->instances[$key])){
            return true;
        }
        return false;
    }
    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static;
        }
        return static::$instance;
    }

    public function make($class)
    {
        if (isset($this->instances[$class])){
            return $this->instances[$class];
        }
        return $this->instances[$class] = new $class();
    }

    public function bind($abstract,$object)
    {
        if (isset($this->instances[$abstract])){
            return $this->instances[$abstract];
        }
        return $this->instances[$abstract] =$object;
    }


}
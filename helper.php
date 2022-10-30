<?php

function base_path()
{
    return __DIR__.'/';
}

function full_path($sub_path)
{
    return base_path() . trim($sub_path, '/');
}

function app($class = null)
{
    if (is_null($class)) {
        return \Mts\Lib\Core\Application::getInstance();
    }

    return \Mts\Lib\Core\Application::getInstance()->make($class);
}

function config($key){
   return app(\Mts\Lib\Core\Config::class)->get($key);
}

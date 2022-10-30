<?php


namespace Mts\Command;


class MigrateCommand implements Command
{
    public static function handle(){

        echo "migrate running... \n";
        foreach (glob(full_path('migration').'/*.php') as $file)
        {
            require_once $file;
            $class = basename($file, '.php');
            $class = preg_replace('/[0-9]+_/','',$class);
            if (class_exists($class))
            {
                $obj = new $class;
                $obj->up();
            }
        }
        echo "migrate finished \n";
    }
}
<?php


namespace Mts\Command;


class Kernel
{
    private $command=[
        'sheet'=> SheetCommand::class,
        'migrate'=> MigrateCommand::class,
        'migrate:rollback'=> MigrateDownCommand::class,
    ];
    public function run($command){
        if(isset($this->command[$command])){
            $this->command[$command]::handle();
        }
        else{
            throw new \Exception('command not exist');
        }
    }
}
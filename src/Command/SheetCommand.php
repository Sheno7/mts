<?php


namespace Mts\Command;


use Mts\Lib\Database\DB;
use Mts\Lib\Sheet\Sheet;

class SheetCommand implements Command
{
    public static function handle()
    {
        echo "sheet command running... \n";
        $kernel=new Kernel();
        $kernel->run('migrate:rollback');
        $kernel->run('migrate');

        $sheet=new Sheet('data.xlsx');
        $sheet->import();
        $sheet->save();

        echo "sheet finished \n";
    }
}
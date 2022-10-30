<?php


namespace Mts\Migration;


class SqliteMigrationBuilder extends MigrateBuild
{
    public function primaryKey($name)
    {
        $this->tableColumns .= "$name INTEGER PRIMARY KEY AUTOINCREMENT,";
        return $this;
    }
}
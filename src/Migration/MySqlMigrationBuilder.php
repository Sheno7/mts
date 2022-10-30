<?php


namespace Mts\Migration;


class MySqlMigrationBuilder extends MigrateBuild
{
    public function primaryKey($name)
    {
        $this->tableColumns .= "$name int(11) AUTO_INCREMENT PRIMARY KEY,";
        return $this;
    }
    public function int($name)
    {
        $this->tableColumns .= "$name int(11),";
        return $this;
    }

}
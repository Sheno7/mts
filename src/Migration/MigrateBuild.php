<?php


namespace Mts\Migration;


class MigrateBuild
{
    protected $tableColumns = '';

    public function primaryKey($name)
    {
        $this->tableColumns .= "$name INTEGER PRIMARY KEY AUTOINCREMENT,";
        return $this;
    }

    public function int($name)
    {
        $this->tableColumns .= "$name INTEGER,";
        return $this;
    }
    public function date($name)
    {
        $this->tableColumns .= "$name Date,";
        return $this;
    }

    public function float($name)
    {
        $this->tableColumns .= "$name decimal(6,3),";
        return $this;
    }

    public function string($name)
    {
        $this->tableColumns .= "$name char(250),";
        return $this;
    }

    public function foreign($name, $referenceTable, $referenceKey)
    {
        $this->tableColumns .= "FOREIGN KEY($name) REFERENCES $referenceTable($referenceKey),";
        return $this;
    }

    public function finish()
    {
        return trim($this->tableColumns, ',');
    }
}
<?php


namespace Mts\Lib\Database\Builder;


class SqlBuilder extends Builder
{

    protected $query = '';
    protected $table;
    protected $where = true;
    protected $whereItems = [];

    public function table($table)
    {
        $this->table = $table;
        return $this;
    }

    public function select(...$params)
    {
        $paramString = '';
        if (count($params) == 0) {
            $this->query = "select * from $this->table ";
            return $this;
        }
        foreach ($params as $param) {
            $paramString .= "$param,";
        }
        $paramString = trim($paramString, ',');
        $this->query = "select $paramString from $this->table ";
        return $this;
    }

    public function join($table, $id, $foreignKey, $type = 'LEFT')
    {
        $this->query .= "$type join $table on $id = $foreignKey ";
        return $this;
    }

    //add here rest of function you need

    public function update()
    {
        // TODO: Implement update() method.
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }
    public function sort()
    {
        // TODO: Implement delete() method.
    }
    public function limit()
    {
        // TODO: Implement delete() method.
    }
    public function groupBy()
    {
        // TODO: Implement delete() method.
    }

    public function insert($data)
    {
        $items='';
        $values='';
        foreach ($data as $key => $param) {
            $items .="$key,";
            $values.='?,';
        }
        $items=trim($items,',');
        $values=trim($values,',');
        $this->query="insert into $this->table ($items) values ($values)";
        return $this->connection->insert($this->query,array_values($data));
    }

    public function where($key, $operator, $value, $type = "and")
    {
        if ($this->where) {
            $this->query .= "where ";
            $this->where = false;
        } else {
            $this->query .= "$type ";
        }
        $this->query .= "$key $operator ? ";
        $this->whereItems[] = $value;
        return $this;
    }

    //begin scope if you want make multi condition in ()
    // type and , or
    public function beginScope($type)
    {
        $this->query = "$type (";
    }

    public function endScope()
    {
        $this->query = ') ';
        return $this;
    }

    public function get()
    {
        $result = $this->connection->get($this->query, $this->whereItems);
        return $result;
    }

    public function beginTransaction(){
        $this->connection->beginTransaction();
    }
    public function commit(){
        $this->connection->commit();
    }
    public function rollback(){
        $this->connection->rollback();
    }

    public function prepare($query,$options=[]){
        $this->connection->execute($query,$options);
    }

}
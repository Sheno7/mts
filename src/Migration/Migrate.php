<?php


namespace Mts\Migration;


use Mts\Lib\Database\DB;

abstract class Migrate
{
    protected $query;

    public function create($name, $callback)
    {
        $migrateBuilder = $this->getBuilder();
        $data = $callback($migrateBuilder);
        $this->query = "CREATE TABLE IF NOT EXISTS $name ($data)";
        DB::connection()->prepare($this->query);
    }

    public function drop($table)
    {
        $connectionName = config('database.default');
        $connectionData = config("database.connections.$connectionName");
        $driver = $connectionData['driver'];
        if ($driver == 'mysql') {
            $this->query = "SET foreign_key_checks = 0;DROP TABLE IF EXISTS $table";
        } else {
            $this->query = "DROP TABLE IF EXISTS $table";
        }
        DB::connection()->prepare($this->query);
    }

    private function getBuilder()
    {
        $connectionName = config('database.default');
        $connectionData = config("database.connections.$connectionName");
        $driver = $connectionData['driver'];
        switch ($driver) {
            case 'sqlite':
                return new SqliteMigrationBuilder();
                break;
            case 'mysql':
                return new MySqlMigrationBuilder();
                break;
        }
    }

    public abstract function up();

    public abstract function down();
}
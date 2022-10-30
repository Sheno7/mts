<?php

use Mts\Migration\Migrate;
use \Mts\Migration\MigrateBuild;

class CustomerMigration extends Migrate
{
    public function up()
    {
        $this->create('customers',function (MigrateBuild $build){
            $build->primaryKey('id');
            $build->string('name');
            $build->string('address');
            return $build->finish();
        });
        echo "customers created\n";
    }

    public function down()
    {
        $this->drop('customers');
        echo "customers dropped\n";
    }
}
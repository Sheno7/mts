<?php
use Mts\Migration\Migrate;
use Mts\Migration\MigrateBuild;

class ProductMigration extends Migrate
{
    public function up()
    {
        $this->create('products',function (MigrateBuild $build){
            $build->primaryKey('id');
            $build->string('name');
            $build->float('price');
            return $build->finish();
        });
        echo "products created\n";
    }

    public function down()
    {
        $this->drop('products');
        echo "products dropped\n";
    }
}
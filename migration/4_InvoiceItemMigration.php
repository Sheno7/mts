<?php

use Mts\Migration\Migrate;
use Mts\Migration\MigrateBuild;

class InvoiceItemMigration extends Migrate
{
    public function up()
    {
        $this->create('invoice_items', function (MigrateBuild $build) {
            $build->primaryKey('id');
            $build->int('invoice_id');
            $build->int('product_id');
            $build->int('quantity');
            $build->float('item_price');
            $build->float('total_price');
            $build->foreign('invoice_id', 'invoices', 'id');
            $build->foreign('product_id', 'products', 'id');
            return $build->finish();
        });
        echo "invoice_items created\n";
    }

    public function down()
    {
        $this->drop('invoice_items');
        echo "invoice_items dropped\n";
    }
}
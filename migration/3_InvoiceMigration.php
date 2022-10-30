<?php

use Mts\Migration\Migrate;
use Mts\Migration\MigrateBuild;

class InvoiceMigration extends Migrate
{
    public function up()
    {
        $this->create('invoices', function (MigrateBuild $build) {
            $build->primaryKey('id');
            $build->int('customer_id');
            $build->float('grand_price');
            $build->date('invoice_date');
            $build->foreign('customer_id','customers','id');
            return $build->finish();
        });
        echo "invoices created\n";
    }

    public function down()
    {
        $this->drop('invoices');
        echo "invoices dropped\n";
    }
}
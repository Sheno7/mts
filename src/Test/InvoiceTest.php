<?php


namespace Mts\Test;

use Mts\Lib\Database\DB;

class InvoiceTest extends TestCase
{
    public function testProject(){
        $this->loadConfig();
        $data=DB::connection()->table('customers')->select()->get();
        $this->assertIsArray($data);
    }
}
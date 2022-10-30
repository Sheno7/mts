<?php


namespace Mts\Controller;


use Mts\Lib\Database\DB;

class HotelController extends Controller
{

    public function get()
    {
        $data = DB::connection()
            ->table('invoices')
            ->select('invoices.id as invoice_id',
                'invoices.invoice_date',
                'customers.name as customer_name',
                'customers.address as customer_address',
                'products.name as product_name',
                'invoice_items.quantity as quantity',
                'invoice_items.item_price as price',
                'invoice_items.total_price as total',
                'invoices.grand_price as grand_price')
            ->join('customers', 'customers.id', 'invoices.customer_id')
            ->join('invoice_items', 'invoices.id', 'invoice_items.invoice_id')
            ->join('products', 'products.id', 'invoice_items.product_id')
            ->get();
        return $this->response->status(200)->toJson($data);
    }
}
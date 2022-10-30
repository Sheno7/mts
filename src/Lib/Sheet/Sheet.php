<?php


namespace Mts\Lib\Sheet;


class Sheet
{
    protected $customers = [];

    public static $INVOICE_ID;
    public static $INVOICE_DATE;
    public static $CUSTOMER_NAME;
    public static $CUSTOMER_ADDRESS;
    public static $PRODUCT_NAME;
    public static $QUANTITY;
    public static $PRICE;
    public static $TOTAL_PRICE;
    public static $GRAND_PRICE;

    public $data = [];

    public function __construct($file)
    {
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
        $spreadsheet = $reader->load(full_path($file));
        $data = $spreadsheet->getActiveSheet()->toArray(NULL,TRUE,false);
        foreach ($data[0] as $key => $value) {
            switch ($value) {
                case 'invoice';
                    Self::$INVOICE_ID = $key;
                    break;
                case 'Invoice Date';
                    Self::$INVOICE_DATE = $key;
                    break;
                case 'Customer Name';
                    Self::$CUSTOMER_NAME = $key;
                    break;
                case 'Customer Address';
                    Self::$CUSTOMER_ADDRESS = $key;
                    break;
                case 'Product Name';
                    Self::$PRODUCT_NAME = $key;
                    break;
                case 'Qyantity';
                    Self::$QUANTITY = $key;
                    break;
                case 'Price';
                    Self::$PRICE = $key;
                    break;
                case 'Total';
                    Self::$TOTAL_PRICE = $key;
                    break;
                case 'Grand Total';
                    Self::$GRAND_PRICE = $key;
                    break;
            }
        }
        unset($data[0]);
        $this->data = $data;
    }

    public function import()
    {
        foreach ($this->data as $item) {
            $index = $this->getIndex($item[self::$CUSTOMER_NAME], $item[self::$CUSTOMER_ADDRESS]);
            if (!is_null($index)) {
                $this->customers[$index]->setInvoice($item);
            } else {
                $customer = new Customer();
                $customer
                    ->setName($item[self::$CUSTOMER_NAME])
                    ->setAddress($item[self::$CUSTOMER_ADDRESS])
                    ->setInvoice($item);
                $this->customers[] = $customer;
            }
        }
    }

    public function save(){
        foreach ($this->customers as $customer){
            $customer->save();
        }
    }

    private function getIndex($name, $address)
    {
        foreach ($this->customers as $key => $customer) {
            if ($customer->getName() == $name and $customer->getAddress() == $address) {
                return $key;
            }
        }
        return null;
    }
}
<?php


namespace Mts\Lib\Sheet;


use Mts\Lib\Database\DB;

class Customer
{
    protected $id;
    protected $name;
    protected $address;
    protected $invoices = [];

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Customer
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Customer
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     * @return Customer
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return array
     */
    public function getInvoices()
    {
        return $this->invoices;
    }

    /**
     * @param array $invoice
     * @return Customer
     */
    public function setInvoice($item)
    {
        if (isset($this->invoices[Sheet::$INVOICE_ID])) {
            $this->invoices[Sheet::$INVOICE_ID]->setItems($item);
        } else {
            $invoice = new Invoice();
            $invoice
                ->setId($item[Sheet::$INVOICE_ID])
                ->setDate($item[Sheet::$INVOICE_DATE])
                ->setGrandTotal($item[Sheet::$GRAND_PRICE])
                ->setItems($item);
            $this->invoices[] = $invoice;
        }
        return $this;
    }

    public function save()
    {
        $data = DB::connection()
            ->table('customers')
            ->select('id')
            ->where('name', '=', $this->getName())
            ->where('address', '=', $this->getAddress())->get();
        if (count($data) == 0) {
            $id = DB::connection()->table('customers')->insert([
                'name' => $this->getName(),
                'address' => $this->getAddress(),
            ]);
        } else {
            $id = $data[0]['id'];
        }
        foreach ($this->getInvoices() as $invoice) {
            $invoice->save($id);
        }
        return $id;
    }

}
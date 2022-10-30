<?php


namespace Mts\Lib\Sheet;


use Mts\Lib\Database\DB;

class Invoice
{
    protected $id;
    protected $customerId;
    protected $grandTotal;
    protected $date;
    protected $items = [];

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Invoice
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $id
     * @return Invoice
     */
    public function setDate($date)
    {
        $this->date = $date;
        $resultDate=\PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp((float)$date);
        $this->date= date('Y-m-d',$resultDate);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * @param mixed $customerId
     * @return Invoice
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGrandTotal()
    {
        return $this->grandTotal;
    }

    /**
     * @param mixed $grandTotal
     * @return Invoice
     */
    public function setGrandTotal($grandTotal)
    {
        $this->grandTotal = $grandTotal;
        return $this;
    }

    /**
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param array $items
     * @return Invoice
     */
    public function setItems($row)
    {
        $item = new Item();
        $item
            ->setInvoiceId($row[Sheet::$INVOICE_ID])
            ->setItemPrice($row[Sheet::$PRICE])
            ->setQuantity($row[Sheet::$QUANTITY])
            ->setTotalPrice($row[Sheet::$TOTAL_PRICE])
            ->setProduct($row);
        $this->items[] = $item;
        return $this;
    }

    public function save($customerId)
    {
        $id = DB::connection()->table('invoices')->insert([
            'id' => $this->getId(),
            'customer_id' => $customerId,
            'grand_price' => $this->getGrandTotal(),
            'invoice_date' => $this->getDate()
        ]);
        foreach ($this->getItems() as $item) {
            $item->save();
        }
        return $id;
    }

}
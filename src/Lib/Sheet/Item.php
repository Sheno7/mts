<?php


namespace Mts\Lib\Sheet;


use Mts\Lib\Database\DB;

class Item
{
    protected $id;
    protected $invoiceId;
    protected $quantity;
    protected $itemPrice;
    protected $totalPrice;
    protected $product = null;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Product
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getInvoiceId()
    {
        return $this->invoiceId;
    }

    /**
     * @param mixed $invoiceId
     * @return Product
     */
    public function setInvoiceId($invoiceId)
    {
        $this->invoiceId = $invoiceId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     * @return Product
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getItemPrice()
    {
        return $this->itemPrice;
    }

    /**
     * @param mixed $itemPrice
     * @return Product
     */
    public function setItemPrice($itemPrice)
    {
        $this->itemPrice = $itemPrice;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    /**
     * @param mixed $totalPrice
     * @return Product
     */
    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;
        return $this;
    }

    /**
     * @return null
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param null $product
     * @return Product
     */
    public function setProduct($row)
    {
        $product = new Product();
        $product
            ->setName($row[Sheet::$PRODUCT_NAME])
            ->setPrice($row[Sheet::$PRICE]);
        $this->product = $product;
        return $this;
    }

    public function save()
    {
        $productId = $this->getProduct()->save();
        $id = DB::connection()->table('invoice_items')->insert([
            'invoice_id' => $this->getInvoiceId(),
            'product_id' => $productId,
            'quantity' => $this->getQuantity(),
            'item_price' => $this->getItemPrice(),
            'total_price' => $this->getTotalPrice()
        ]);
        return $id;
    }
}
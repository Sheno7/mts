<?php


namespace Mts\Lib\Sheet;


use Mts\Lib\Database\DB;

class Product
{
    protected $id;
    protected $name;
    protected $price;

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    public function save()
    {
        $data = DB::connection()
            ->table('products')
            ->select('id')
            ->where('name', '=', $this->getName())->get();
        if (count($data) == 0) {
            $id = DB::connection()->table('products')->insert([
                'name' => $this->getName(),
                'price' => $this->getPrice(),
            ]);
        } else {
            $id = $data[0]['id'];
        }
        return $id;
    }


}
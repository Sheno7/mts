<?php


namespace Mts\Lib\Core;


class Config
{
    public static $items = array();

    public function load($filepath)
    {
        static::$items[$this->getFileName($filepath)] = include($filepath);
    }

    /**
     * Searches the $items array and returns the item
     *
     * @param string $item
     * @return  string
     */
    public function get($key = null)
    {
        $input = explode('.', $key);
        $result = static::$items;
        while ($index = array_shift($input)) {
            if (isset($result[$index])) {
                $result = $result[$index];
            } else {
                return '';
            }
        }
        return $result;
    }

    public function getFileName($filepath)
    {
        $arr = explode('/', $filepath);
        return trim(array_pop($arr), '.php');
    }
}
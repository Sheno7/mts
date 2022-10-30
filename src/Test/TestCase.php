<?php


namespace Mts\Test;
use PHPUnit\Framework\TestCase as BaseCase;

class TestCase extends BaseCase
{
    public function loadConfig()
    {
        foreach (glob(full_path('config')."/*.php") as $file) {
            app()->make(\Mts\Lib\Core\Config::class)->load($file);
        }
    }
}
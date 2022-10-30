<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = new \Mts\Lib\Core\Application();

foreach (glob(__dir__ . "/../config/*.php") as $file) {
    $app->make(\Mts\Lib\Core\Config::class)->load($file);
}
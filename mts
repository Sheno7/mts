#!/usr/bin/env php
<?php
require_once __DIR__ .'/src/bootstrap.php';

$kernel=new \Mts\Command\Kernel();
$kernel->run($_SERVER['argv'][1]);
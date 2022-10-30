<?php
include __dir__ . '/../src/bootstrap.php';

$app->start();
require_once __DIR__ . '/../src/Route/route.php';
$app->close();
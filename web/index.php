<?php
ob_start();
require_once __DIR__ . '/../vendor/autoload.php';

$start = new \App\App();
$start->start();

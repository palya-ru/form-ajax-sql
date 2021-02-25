<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$loader = new FilesystemLoader('templates');
$twig = new Environment($loader, [
    //'cache' => '/path/to/compilation_cache',
]);

echo $twig->render('index.html', ['the' => 'variables', 'go' => 'here']);

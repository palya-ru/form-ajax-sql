<?php


namespace App;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;
class View
{
    public function __construct()
    {
        $loader = new FilesystemLoader('templates');
        $twig = new Environment($loader, [
            'cache' => 'compilation_cache',
        ]);
        echo $twig->render('index.html', [
            'name' => $_SERVER['SERVER_NAME']]);
    }
}

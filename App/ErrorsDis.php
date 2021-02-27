<?php


namespace App;

use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;
class ErrorsDis
{
    public function __construct()
    {
        $whoops = new Run;
        $whoops->pushHandler(new PrettyPageHandler);
        $whoops->register();
    }
}

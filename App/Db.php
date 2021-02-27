<?php


namespace App;


class Db
{
    protected $fluent;
    protected $database = 'info';
    protected $name = 'name';
    protected $tel = 'tel';
    protected $prise = 'prise';

    public function __construct()
    {
        $config = (require_once __DIR__ . '/../conf.php')['db'];
        $pdo = new \PDO('mysql:host='.$config['host'].';dbname='.$config['dbname'],
            $config['user'],$config['password']);
        $this->fluent = new \Envms\FluentPDO\Query($pdo);
    }

}

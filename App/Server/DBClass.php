<?php
namespace App\Server;

use App\Base;
use App\Config;


class DBClass extends Base{
    public $conf;
    public $pdo;
    public function __construct(Config $config)
    {
        parent::__construct();
        $this->conf = $config::returnConfig();
        $this->connect();
    }
    public function connect(){

        $dbms   = $this->conf['dbms'];
        $host   = $this->conf['host'];
        $dbName = $this->conf['dbName'];    //使用的数据库
        $user   = $this->conf['dbUsr'];
        $pass   = $this->conf['dbPsw'];
        $dsn    = "$dbms:host=$host;dbname=$dbName";


        try {
            $this->pdo = new \PDO($dsn, $user, $pass, array(\PDO::ATTR_PERSISTENT => true));
        } catch (PDOException $e) {
            die ("Error!: " . $e->getMessage() . "<br/>");
        }

    }
}
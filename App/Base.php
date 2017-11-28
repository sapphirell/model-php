<?php
namespace App;

class Base {

    protected $container;
    public $config;

    public function __construct()
    {
        error_reporting(E_ERROR);
        $this->config = config::returnConfig();
    }
}

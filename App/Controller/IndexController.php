<?php
namespace App\Controller;

use App\Base;

class IndexController extends Base {
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        return 'hello,Moe';
    }
}
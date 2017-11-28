<?php
namespace App\Server;

use App\Base;
use App\Controller\User\UserTestController;
use App\route;

class TestClass extends Base{

    public function __construct()
    {
        parent::__construct();
        //        $this->route  =   new route();

    }
    public function a()
    {
        echo "yes";
    }

}
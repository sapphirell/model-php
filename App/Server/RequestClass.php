<?php
namespace App\Server;

use App\Base;
use App\Controller\User\UserTestController;


class RequestClass extends Base{

    public function __construct(UserTestController $userTestController)
    {
        parent::__construct();
//        $this->route  =   new route();

    }
    public function getPathInfo(){
//        $pathArray  =   explode("/",$_SERVER['PATH_INFO']);
        echo 1;
    }
    public function testRequest(){
        return 'testOk';
    }

}
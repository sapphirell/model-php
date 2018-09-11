<?php
namespace App\Server;

use App\Base;

class TestClass extends Base{

    public function __construct()
    {
        parent::__construct();

    }
    public function a()
    {
        echo "yes";
    }

}
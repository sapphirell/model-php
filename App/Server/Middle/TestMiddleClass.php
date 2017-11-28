<?php
namespace App\Server\Middle;

class TestMiddleClass
{
    public function relay()
    {
        echo "~~";
        if (1==2)
        {
            echo "fail";
            return false;
        }
        return true;
    }
}
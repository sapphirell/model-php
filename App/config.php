<?php
namespace App;
class Config extends Base{

    static function returnConfig()
    {
        return parse_ini_file("config.ini");
    }


}

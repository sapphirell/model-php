<?php
namespace App;
class config extends Base{

    static function returnConfig()
    {
        return parse_ini_file("config.ini");
    }


}

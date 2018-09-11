<?php

require "vendor/autoload.php";

use App\Config;


/**
 * index->router->container,根据router的get参数，
 * 通过container实现control类并用反射类得到control的构造函数进行依赖注入
 */

$route = New \App\Route(function () {
    return Config::returnConfig();
});

echo $route->useDistribute();




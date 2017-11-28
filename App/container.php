<?php

namespace App;

use App\Controller\User\UserTestController;
use App\Server\RequestClass;

class Container {
    public $config;
    public $reflection;

    public function __construct($namespace)
    {
        #'\App\Controller\__DIR__\__CLASS__'
        try {
            $this->reflection = new \ReflectionClass($namespace);
        }catch (Exception $e){
            echo $namespace;
        }

    }
    public function binder(){}
    public function builder($routeInfo)
    {
        //从route中得到的control名称
        $this->reflection->getMethod($routeInfo['func'])->invoke
        (
            $this->autoBuilder()
        );

    }
    public function autoBuilder()
    {
        return $this->batchInstantiation #对构造函数赋值
        (
            $this->getPrototypeController($this->reflection)#获得字串
        );
    }
    protected final function getPrototypeController(\ReflectionClass $object)
    {
        //批量从反射类中获取原型字串
        foreach ($object->getConstructor()->getParameters() as $parameter)
        {
            $prototype[]    =   $parameter->getClass()->name;
        }

        return $prototype?:[];
    }
    protected final function batchInstantiation(array $prototypeArr)
    {
        foreach ($prototypeArr as $item)
        {
            $container = new container($item);
            $insArr[] = $container->autoBuilder();//进行递归注入
        }

        return empty($prototypeArr) ? $this->reflection->newInstance() : $this->reflection->newInstanceArgs($insArr);
    }
}
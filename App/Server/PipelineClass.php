<?php
namespace App\Server;

use App\Base;
use App;

class PipelineClass extends Base
{
    protected $middleware;
    protected $group;
    public function __construct()
    {
        $this->middleware = [
            'group1' => [
                'elements' => [ //路由组
                    '/', '/index'
                ],
                'unit' => [ //触发的中间件类
                    'Test'
                ]
            ]
        ];
    }

    public function load($routePath)
    {
        foreach ($this->middleware as $key => $value)
        {

             if (in_array($routePath,$value['elements']))
             {
                 array_walk($value['unit'],function ($className,$key){
                     if ($this->next($className) == false)
                     {
                         die();
                     };
                 });

             }
        }
    }
    public function next($className)
    {
        $r = new \ReflectionClass("App\\Server\\Middle\\" . $className ."MiddleClass");
        $modle = $r->newInstance();
        return $modle->relay();
    }
}
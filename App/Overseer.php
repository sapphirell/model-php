<?php
/**
 * 使用php命令启动起来作为常驻进程使用,循环取队列处理
 */
//include "config.php";
//include "Server/RedisClass.php";
namespace App;
require "../vendor/autoload.php";
use App;
use App\Server;


$redis = new \Redis();
$config = new Config();
$redisClass = new Server\RedisClass($config,$redis);


while ($task = $redisClass->redis->rPop('queueMaster'))
{
    $taskDetail = explode('|',$task);

    $worker = new \ReflectionClass("App\\Server\\Queue\\" . $taskDetail[0]);

    $instance = $worker->newInstance();

    while ($work = $redisClass->redis->rPop($taskDetail[0]))
    {
        $instance->main($work);
        //队列延迟
        if ($taskDetail[1])
        {
            sleep($taskDetail[1]);
        }

    }

}
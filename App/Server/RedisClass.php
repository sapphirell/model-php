<?php
/**
 * 队列类
 */

namespace App\Server;


use App\Base;
use App\config;

class RedisClass extends Base
{
    public $redis;
    public function __construct(config $config,\Redis $redis)
    {
        $this->redis = $redis;
        empty($config) or $this->connect($config::returnConfig());
    }
    public function connect($config)
    {
        $this->redis->connect($config['cache_server'], $config['cache_port']);
    }
    public function cache()
    {
        //为了避免失效,第一个查询的请求会去生成缩并查询
        
    }
}
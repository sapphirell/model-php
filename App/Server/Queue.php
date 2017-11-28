<?php
/**
 * 队列类
 */

namespace App\Server;


use App\Base;

class Queue extends Base
{
    /**
     * @var 去App/Server/Queue下执行的名
     */
    public $task;
    public $redis;
    /**
     * @var 间隔多少秒执行一次子list内的动作
     */
    public $delay;
    /**
     * @var 传递给worker的参数
     */
    public $values;
    public function __construct(RedisClass $redisClass)
    {
        $this->redis = $redisClass->redis;
    }
    public function task($taskName)
    {
        $this->task = $taskName;

        return $this;
    }
    public function delay($delay)
    {
        $this->delay = $delay;

        return $this;
    }
    public function values($values)
    {
        $this->values[] = $values;

        return $this;
    }
    public function makeTask()
    {
        $this->redis->lPush('queueMaster',$this->task."|".$this->delay);
        foreach ($this->values as $value)
        {
            $this->redis->lPush($this->task,$value);
        }

    }
}
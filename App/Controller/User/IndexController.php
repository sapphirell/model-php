<?php
namespace App\Controller\User;

use App\Base;
use App\Model\ModelClass;
use App\Server\DBClass;
use App\Server\PDClass;
use App\Server\Queue;
use App\Server\RedisClass;
use App\Server\RequestClass;
use App\Server\UploadClass;

class IndexController extends Base {
    public $model;
    public $upload;
    public $redis;
    public $queue;
    public function __construct
    (
        RequestClass $requestClass,
        ModelClass $modelClass,
        UploadClass $upload,
        RedisClass $redisClass,
        Queue $queue)//App\Model\ModelClass $modelClass
    {
        $this->model = $modelClass;
        $this->upload = $upload;
        $this->redisClass = $redisClass;
        $this->queue = $queue;
    }
    public function tester()
    {
        $res = $this->model->table('user')->select("*")->where(['id'=>'1'])->getAll();

        echo "<form action='/upload_file' method=\"post\"enctype=\"multipart/form-data\">

                <label for=\"file\">Filename:</label>
                <input type=\"file\" name=\"avatar\" id=\"file\" /> 
                <br />
                <input type=\"submit\" name=\"submit\" value=\"Submit\" />
              </form>
            ";
//        $this->redisClass->redis->set('1','2');
//        var_dump($this->redisClass->redis->get(1));
        $this->queue->task('mission1')->delay(1)->values(2222)->values(232323)->values(23123123333555)->makeTask();


    }
    public function index(){
        return $this->tester();
    }
    public function upload()
    {
        $this->upload->max_size = "1024*1024";
        $this->upload->path = "new";
        $this->upload->new_name = "new.jpg";
        $this->upload->upload('avatar');
    }
}

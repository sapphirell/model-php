<?php
namespace App\Server;

use App\Base;

class UploadClass extends Base{

    public $max_size;
    public $path;
    public $new_name;
    public $root_path;
    public $ext;
    protected $file;
    /**
     * 上传错误信息
     * @var string
     */
    private $error = ''; //上传错误信息

    public function __construct()
    {
        parent::__construct();
        $this->root_path = dirname(dirname(__DIR__)) . '/upload/';
    }

    /**
     * 获取最后一次上传错误信息
     * @return string 错误信息
     */
    public function getError(){
        return $this->error;
    }
    public function upload($file){
        if(empty($file)){
            $this->error = '没有选择文件';
            return false;
        }
        if (empty($_FILES[$file]))
        {
            $this->error = '上传未成功:'.$_FILES[$file]["error"];
            return false;
        }

        if ($this->ext && $this->ext != $_FILES[$file]["type"])
        {
            $this->error = '不被允许的类型';
            return false;
        }
        mkdir($this->root_path.$this->path,0777,true);
        if(!is_dir($this->root_path.$this->path)){
            $this->error = "上传目录不存在";
            return false;
        }
        $this->new_name = $this->new_name ?  : md5(time());
        $fileSavePath = $this->root_path.$this->path . "/{$this->new_name}";

        $move = move_uploaded_file($_FILES[$file]["tmp_name"],$fileSavePath);
        var_dump($fileSavePath);
        if (move_uploaded_file($_FILES[$file]["tmp_name"],$fileSavePath))
        {
            return true;
        }

        return false;


    }



}
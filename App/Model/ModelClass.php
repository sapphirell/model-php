<?php
namespace App\Model;
use App\Base;
use App\Server\DBClass;

class ModelClass extends Base{

    public $db;
    public $table;
    public $sql;
    protected $method;
    protected $queryValue;
    public function __construct(DBClass $DBClass)
    {
        parent::__construct();

        $this->db = $DBClass->pdo;
//        $this->db = $this->setFetchMode(\PDO::FETCH_ASSOC);
        $this->sql = new \stdClass();
        $this->method = ['where','select','limit','order','table'];


    }

    public function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
        if (in_array($name, $this->method))
        {
            $this->sql->{$name} = $arguments;
            return $this;
        }
    }
    public function getAll()
    {
        //select
        if ($this->sql->select)
        {
            $select = implode(",",$this->sql->select);
            $select = rtrim($select,',');
        }
        else
        {
            $select = " * ";
        }
        //表
        if ($this->sql->table)
        {
            $table = reset($this->sql->table);
        }

        $sql = "SELECT {$select} FROM {$table} WHERE 1=1";
        //准备参数
        foreach ($where = $this->sql->where as $key => $value)
        {
            $param      = array_keys($value)[0];


            $sql .= " AND {$param} = :{$param}";
        }

        $bind = $this->db->prepare($sql);
//        var_dump($where);
        //绑定
        foreach ($where as $key => $value)
        {
            $bind_val = reset(array_values($value));
            $bind_key = reset(array_keys($value));
            $bind->bindValue(":{$bind_key}",$bind_val);
        }

        $bind->execute();
        return $bind->fetchAll();


    }

    /**
     * @param        $sql
     * @param string $type
     * @param bool   $safe 是否安全执行sql,如果是ture,则必须检测sql中是否含有where条件,避免失误执行update全表
     *
     */
    public function query($sql,$type='select',$safe=true)
    {
        if ($type = 'select')
        {
            $res = $this->db->query($sql);
        }
        else if ($type = 'exec')
        {
            if ($safe)
            {
                if (preg_match('/\bwhere\b/i', $sql))
                {
                    $res = $this->db->exec($sql);
                }
                else
                {
                    return 'param "where" not found';
                }
            }

        }
        return $res;
    }

}
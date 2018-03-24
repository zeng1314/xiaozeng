<?php
/**
 * Created by PhpStorm.
 * User: zengqingxin
 * Date: 2018/3/22
 * Time: 下午8:49
 */

namespace houdunwang\model;
use PDO;
use Exception;

class Base
{
    private static $pdo=null;
    private $table;
    private $where = '';
    private $order = '';
    private $limit = '';
    private $keywords = '';
    /**
     * 构造方法，通过判断属性值$pdo是否为null来控制只连接一次数据库
     * Base constructor.    Base类的构造方法，自动执行
     * @throws Exception    抛出错误
     */
    public function __construct($modelName)
    {

        //判断$pdo是否为null
        if(is_null(self::$pdo)){
            try{
                $dsn = 'mysql:host='.c('database.host').';dbname='.c('database.dbname');
                // 连接数据库
                self::$pdo=new PDO($dsn,c('database.username'),c('database.password'));
                //设置编码
                self::$pdo->query('set names utf8');
                // 设置错误属性为异常错误
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            }catch (Exception $e){
                //输出错误信息
                throw new Exception($e->getMessage());
            }
        }
        // p($modelName);
        //将类名路径从右侧以\为标记进行截取，然后删除\ ，再转换为小写
        $this->table = strtolower(ltrim(strrchr($modelName,'\\'),'\\'));
        // p($this->table);
    }

    /**
     * 查询where条件
     * @param $where
     * @return $this
     */
    public function where($where){
        $this->where = $where ? ' where '.$where : '';
        return $this;
    }

    /**
     * 查询排序
     * @param string $order
     * @return $this
     */
    public function order($order=''){
        if(isset($order)){
            // $info = explode('.',$order);
            $this->order = ' order by '.$order;
        }else{
            $this->order = '';
        }
        return $this;
    }


    /**
     * 查询关键字
     * @param string $keywords
     * @return $this
     * @throws Exception
     */
    public function keywords($keywords=''){
        $res = array_keys(current($this->query('select * from '.$this->table)));
        // p($res);
        if (isset($keywords)){
            $info = explode(',',$keywords);
            foreach ($info as $v){
                // p($v);
                // p($res);
                // p(in_array($v,$res));
                if(!in_array($v,$res)){
                    $this->keywords='*';
                    return $this;
                }
            }
            $this->keywords = $keywords;
        }else{
            $this->keywords='*';
        }
        return $this;
    }

    /**
     * 查询截取
     * @param string $limit
     * @return $this
     */
    public function limit($limit=''){
        if (is_int($limit)){
            $this->limit = ' limit '.$limit;
        }else{
            $this->limit ='';
        }
        return $this;
    }

    /**
     * 查询单条数据
     * @param $pri
     * @return mixed
     * @throws Exception
     */
    public function find($pri){
        // echo 333;
        $priField = $this->getPriField();
        $sql = 'select * from '.$this->table.' where '.$priField.'='.$pri;
        return current($this->query($sql));
    }

    //获取主键名
    public function getPriField(){
        $res = $this->query('desc '.$this->table);
        foreach ($res as $v){
            if ($v['Key']=='PRI'){
                return $v['Field'];
            }
        }
    }

    /**
     * 查询全部数据
     * @return array
     * @throws Exception
     */
    public function get(){
        $sql = 'select '.$this->keywords.' from '.$this->table.$this->where.$this->order.$this->limit;
        return $this->query($sql);
    }

    /**
     * 执行有结果集的方法（select）
     * @param $sql  输入的sql语句
     * @return array    返回值查询到的结果
     * @throws Exception    输出错误信息
     */
    public function query($sql){
        // p($sql);
        try{
            $res = self::$pdo->query($sql);
            // p($res);
            return $res->fetchAll(PDO::FETCH_ASSOC);
            // p($q);
        }catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    /**
     * 执行无结果集的方法（insert、delete、updata）
     * @param $sql  sql语句
     * @return mixed    返回受影响的条数
     * @throws Exception    错误信息
     */
    public function exec($sql){
        try{
            return self::exec($sql);
        }catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }
}
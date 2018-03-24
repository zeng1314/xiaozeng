<?php
/**
 * Created by PhpStorm.
 * User: zengqingxin
 * Date: 2018/3/21
 * Time: 下午2:27
 */

namespace houdunwang\core;
// use app\home\controller\IndexController;

/**
 * 框架启动类
 * Class Boot
 * @package houdunwang\core
 */
class Boot
{
    /**
     * 执行应用
     */
    public static function run(){
        // echo 333;
        // p(3333);
        //初始化框架
        self::init();
        //执行应用类
        self::appRun();
    }

    /**
     * 初始化框架
     */
    private static function init(){
        // echo 333;
        //头部
        header(c('init.header'));
        //设置时区
        date_default_timezone_set(c('init.timezone'));
        // 开启session
        session_id() || session_start();
    }

    /**
     * 执行应用
     */
    private static function appRun(){
        // echo 333;
        // (new IndexController())->index();
        //判断get参数是否存在
        if(isset($_GET['s'])){
            // p($_GET);die();
            // 当有get参数s的时候,用/将参数进行拆分
            $info = explode('/',$_GET['s']);
            // p($info);die();
            // 第0号元素为控制的模型，决定前后台
            $m=$info[0];
            //第1号元素为控制器类
            $c=$info[1];
            //第2号元素为调用的方法
            $a=$info[2];
        }else{
            //如果参数不存在的时候，给$m,$c,$a默认值
            $m='home';
            $c='index';
            $a='index';
        }
        define('MODULE',$m);
        define('CONTROLLER',strtolower($c));
        define('ACTION',$a);
        //组合类的路径
        $controller = 'app\\'.$m.'\\controller\\'.ucfirst($c).'Controller';
        // $action = $a;
        //实例化类调用方法
        echo call_user_func_array([new $controller , $a],[]);
    }
}
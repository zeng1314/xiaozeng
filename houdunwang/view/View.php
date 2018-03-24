<?php
/**
 * Created by PhpStorm.
 * User: zengqingxin
 * Date: 2018/3/22
 * Time: 下午4:46
 */

namespace houdunwang\view;


class View
{
    /**
     * 当静态调用app\home\controller index方法 调用一个不存在的方法时自动触发
     * @param $name 调用的方法名
     * @param $arguments    传的参数
     */
    public static function __callStatic($name,$arguments){
        // p($name);
        // p($arguments);
        return self::runParse($name,$arguments);
    }

    /**
     * 当调用app\home\controller index方法 调用一个不存在的方法时自动触发
     * @param $name 调用的方法名
     * @param $arguments    传的参数
     */
    public function __call($name, $arguments)
    {
        // p($name);
        // p($arguments);
        return self::runParse($name,$arguments);


    }
    public function runParse($name,$arguments){
        // 没有make(),with()方法，去Base()类里面找
        return call_user_func_array([new Base(),$name],$arguments);
    }

}
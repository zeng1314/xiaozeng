<?php
/**
 * Created by PhpStorm.
 * User: zengqingxin
 * Date: 2018/3/22
 * Time: 下午8:49
 */

namespace houdunwang\model;


class Model
{
    // 非静态调用不存在的方法时触发
    public function __call($name, $arguments)
    {
        return self::runParse($name, $arguments);
    }
    //静态调用不存在的方法的时候触发
    public static function __callStatic($name, $arguments){
        // p($name);
        return self::runParse($name, $arguments);
    }

    public static function runParse($name, $arguments){
        // p($name);
        // p($arguments);
        $modelName = get_called_class();
        // p($modelName);
        return call_user_func_array([new Base($modelName),$name],$arguments);
    }
}
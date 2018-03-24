<?php
/**
 * Created by PhpStorm.
 * User: zengqingxin
 * Date: 2018/3/22
 * Time: 下午5:33
 */

namespace houdunwang\view;


class Base
{
    //设置属性$file储存模板路径
    private $file;
    //设置属性$data储存数据
    private $data=[];
    /**
     * 加载模板
     * @param string $tpl   加载的模板路径
     */
    public function make($tpl=''){
        // echo 3333;
        $tpl = $tpl?:ACTION;
        //组合路径、存到属性里面
        $this->file = "../app/".MODULE."/view/".CONTROLLER."/".$tpl.'.'.c('view.suffix');

        return $this;
    }

    /**
     * 分配变量
     * @param $var  传过来的变量
     */
    public function with($var=[]){
        // echo 4444;
        // p($var);
        $this->data=$var;
        // extract($var);
        // p($houdunwang);
        // p($hd);
        return $this;
    }

    public function __toString()
    {
        // 从分配过来的数组中将变量导入当前
        extract($this->data);
        // p($houdunwang);
        // p($hd);
        // 判断file路径是否为null如果不为null的时候加载模板
        if (!is_null($this->file)){
            include $this->file;
        }
        // echo 333333;
        return '';
    }


}
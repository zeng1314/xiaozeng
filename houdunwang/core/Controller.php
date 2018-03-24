<?php
/**
 * Created by PhpStorm.
 * User: zengqingxin
 * Date: 2018/3/22
 * Time: 下午3:08
 */

namespace houdunwang\core;


class Controller
{
    private $url;
    // public function index(){
    //     echo 'welcome';
    // }


    /**
     * 提示信息
     * @param $msg 提示信息的内容
     */
    public function message($msg){
        //加载模板
        include "./view/message.php";
    }

    /**
     * 重定向
     * @param string $url   重新跳转的页面地址
     * @return $this    返回的对象，链式操作
     */
    public function setRedirect($url=''){
        if($url){
            // 指定跳转地址
            $this->url = $url;
        }else{
            //返回到历史路径
            $this->url = 'javascript:history.back();';
        }
        // 将对象返出
        return $this;
    }
}
<?php
/**
 * 打印函数
 * @param $var    打印的变量
 */
function p($var)
{
    echo '<pre style="width: 100%;padding: 5px;background: #CCCCCC;border-radius: 5px">';
    if (is_bool($var) || is_null($var)) {
        var_dump($var);
    } else {
        print_r($var);
    }
    echo '</pre>';
}

/**
 * 定义常量:IS_POST
 * 将侧是否为post请求
 */
define('IS_POST', $_SERVER['REQUEST_METHOD'] == 'POST' ? true : false);

function c($var = null)
{
    // p($var);
    if (is_null($var)) {
        // 扫描目录
        $files = glob('../system/config/*');
        // p($files);
        //设置空数组，用来储存数据
        $data = [];
        // 遍历文件
        foreach ($files as $v) {
            // 获取文件数据
            $content = include "$v";
            // p($content);
            // 截取文件后缀名
            $fileName = basename($v);
            // p($fileName);
            // 获取.php在后缀名中的位置
            $position = strpos($fileName, '.php');
            // p($position);
            //截取字符串
            $index = substr($fileName, 0, $position);
            // p($index);
            // 将后缀名存入数组
            $data[$index] = $content;
        }
        // p($data);
        return $data;
        // echo 333;
    }
    //将$var 拆分成数组
    $info = explode('.',$var);
    //判断如果数组长度为1
    if (count($info)==1){
        $file = '../system/config/'.$info[0].'.php';
        return is_file($file)? include $file:null;
        // p($file);
    }
    //判断数组长度如果为2
    if (count($info)==2){
        $file = '../system/config/'.$info[0].'.php';
        // p($file);
        if (is_file($file)){
            $data = include $file;
            // p($info[1]);
            // p($data[$info[1]]);
            return isset($data[$info[1]])? $data[$info[1]]:null;
        }else{
            return null;
        }
    }

}
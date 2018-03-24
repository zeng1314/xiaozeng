<?php
/**
 * Created by PhpStorm.
 * User: zengqingxin
 * Date: 2018/3/21
 * Time: 下午3:06
 */

namespace app\home\controller;


use houdunwang\core\Controller;
use houdunwang\model\Model;
use houdunwang\view\View;
use system\model\Student;

class IndexController extends Controller
{
    public function index(){
        // parent::index();//测试是否继承父级成功
        // echo 'app,home,conroller,index';
        // echo 33333;
        // 测试是否能走到view里找不到方法自动执行__call方法
        // View::make('index');
        // (new View())->make('welcome');
        // (new View())->with();
        // $houdunwang = [1,2,3];
        // $hd = 'houdunwang';
        // p(compact('houdunwang','hd'));
        // return (new View())->make('welcome')->with(compact('houdunwang','hd'));
        //测试数据库
        // $data = Model::query('select * from student');
        // p($data);

        // $res = c('database.host');
        // p($res);
        //测试数据库配置
        // $data = Model::query('select * from student');
        // p($data);
        //测试模板后缀名
        // return (new View())->make('welcome');
        //测试时区
        // echo date('Y-m-d H:i:s');
        //测试模型
        $data = Student::where('sex="女"')->keywords('name,sex')->order('id desc')->limit(1)->get();
        // $data = Student::keywords();
        p($data);
    }

    public function add(){
        // 调取信息提示方法
        $this->setRedirect()->message('添加成功');
    }
}
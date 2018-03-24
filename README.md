# xiaozeng
梦想从这里起航，理想从这里出发，未来从这里开始... ...

目的
---
*   熟悉什么是框架
*   熟悉框架的核心运行原理
*   熟悉与掌握框架的使用

要求
---
*   框架的运行原理以及全部的流程
*   每行代码加注释
*   不要求默打，这个难度较大

需要用到的知识点
---
*   php
*   mysql
*   composer`项目提交composer的packagist`
*   git简单知识`项目提交至github`

准备工作
---
*   github注册账号
*   创建一个项目
*   克隆下来到www目录
-------------------
安装composer

实现步骤
---
###1.本地创建框架的目录，使用`composer init`初始化项目
```
    composer init 初始化之后会自动生成vendor目录以及composer.json文件
```
###2.构建框架的文件以及目录(目录名全部小写规范)
```
|--app(开发者写代码的地方)
|   |--home(前台模块)
|   |   |--controller(控制器类)
|   |   |--view(视图)
|   |--admin(后台模块)
|   |   |--controller(控制器类)
|   |   |--view(视图)
|--houdunwang(系统核心)
|   |--core(核心类)
|   |--model(模型)
|   |--view(视图)
|--public(入口、静态资源)
|   |--static(静态资源)
|   |--view(公共模板文件)
|--system(配置)
|   |--config(配置项)
|   |--model(处理业务的各种模型类)
```
```
MVC
M---model
V---view
C---controller
```
###3.创建框架的启动类houdunwang\core\Boot.php类`类名首字母大写，目录名小写`
























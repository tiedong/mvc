<?php
//框架的配置文件
return array(
    //数据库的配置信息
    'host'              =>  '127.0.0.1',
    'user'              =>  'root',
    'pass'              =>  'root',
    'dbname'            =>  'sunny',
    'port'              =>  3306,
    'charset'           =>  'utf8',
    'table_prefix'      =>  'sy_',
    
    //smarty的配置
    'left_delimiter'    =>  '<{',
    'right_delimiter'   =>  '}>',
    
    //默认的模块（前台、后台）
    'default_module'    =>  'home',
    //默认的控制器（IndexController）
    'default_controller'=>  'Index',
    //默认的方法（indexAction）
    'default_action'    =>  'indexAction'
    
);
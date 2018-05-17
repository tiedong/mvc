<?php
namespace framework\core;
/*
 * 基础控制器类，用来封装控制器类的公共的方法
 */
class Controller
{
    protected $smarty;
    public function __construct()
    {
        //require './framework/vendor/smarty/Smarty.class.php';
        $this->smarty = new \Smarty();
        $this->smarty -> left_delimiter = '<{';
        $this->smarty -> right_delimiter = '}>';
        $this->smarty -> setTemplateDir('view/tpl');
        $this->smarty  -> setCompileDir('view/tpl_c');
    }
}
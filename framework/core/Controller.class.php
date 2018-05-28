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
        //初始化时区
        $this->initTimezone();
        //初始化smarty
        $this->initSmarty();
    }
    public function initTimezone()
    {
        date_default_timezone_set('PRC');
    }
    public function initSmarty()
    {
        $this->smarty = new \Smarty();
        $this->smarty -> left_delimiter = '<{';
        $this->smarty -> right_delimiter = '}>';
        $this->smarty -> setTemplateDir(APP_PATH.MODULE.'/view/');
        $this->smarty  -> setCompileDir(APP_PATH.MODULE.'/runtime/tpl_c');
    }
}
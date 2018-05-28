<?php
namespace framework\core;
use framework\dao\DAOPDO;
/*
 * 基础模型类，各个模型类中的公共的代码
 */
class Model
{
    protected $dao;
    public function __construct()
    {
        $option = $GLOBALS['config'];
        $this->dao = DAOPDO::getSingleton($option);
    }
}
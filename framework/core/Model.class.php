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
        //require_once '../dao/DAOPDO.class.php';
        $option = array(
            'host' =>   '127.0.0.1',
            'user' =>   'root',
            'pass' =>   'root',
            'dbname' =>   'php_7',
            'port' =>   3306,
            'charset' =>   'utf8',
        );
        $this->dao = DAOPDO::getSingleton($option);
    }
}
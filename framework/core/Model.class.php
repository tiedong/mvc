<?php
namespace framework\core;
use framework\dao\DAOPDO;
/*
 * 基础模型类，各个模型类中的公共的代码
 */
class Model
{
    protected $dao;
    protected $true_table;
    public function __construct()
    {
        $this->initDAO();
        $this->initTrueTable();
    }

    /**
     * 初始化dao对象
     */
    public function initDAO()
    {
        $option = $GLOBALS['config'];
        $this->dao = DAOPDO::getSingleton($option);
    }

    /**
     * 初始化表名
     */
    public function initTrueTable()
    {
        $this->true_table = '`'.$GLOBALS['config']['table_prefix'].$this->logic_table.'`';
    }

    /**
     * 自动插入数据
     */
    public function insert($date)
    {
        $sql= "insert intro $this->true_table";
        die($sql);
    }
}
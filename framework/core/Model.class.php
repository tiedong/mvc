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
    public function insert($data)
    {
        $sql= "insert intro $this->true_table";

        //拼接列表部分
        //获取下表部分
        $fields = array_keys($data);
        //使用参数1函数，处理参数2这个数组，这样处理：遍历参数2数组，数组的值传递到参数这个函数中
        $fields_list = array_map(function($v){
            return '`'.$v.'`';
        },$fields);
        //将函数链接成字符串
        $fields_list = '('.implode(",",$fields_list).')';
        $sql .=$fields_list;

        //获取数组地value值
        $fields_value = array_values($data);
        $fields_value = array_map(array($this->dao,'quote'),$fields_value);
        $fields_value = " VALUES(".implode(",",$fields_value).")";
        $sql .= $fields_value;
        //执行SQL语句
        $this->dao->exec($sql);
        return $this->dao->lastInsertId();
    }
}
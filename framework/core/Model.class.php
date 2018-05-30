<?php
/**
 * @author tiedong
 * @email 1095013906@qq.com
 * @date 2018-05-30
 * 基础模型类，各个模型类中的公共的代码
 */
namespace framework\core;
use framework\dao\DAOPDO;

class Model
{
    protected $dao;
    protected $true_table;
    protected $pk;
    public function __construct()
    {
        $this->initDAO();
        $this->initTrueTable();
        $this->initFields();
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
     * 获取字段值
     */
    public function initFields()
    {
        $sql = "DESC $this->true_table";
        $result = $this->dao->fetchAll($sql);
        //遍历二维数组
        foreach ( $result as $key=>$value ) {
            if ( $value['Key'] == "PRI" ) {

                $this->pk = $value['Field'];
            }
        }
    }

    /**
     * 初始化表名
     */
    public function initTrueTable()
    {
        $this->true_table = '`'.$GLOBALS['config']['table_prefix'].$this->logic_table.'`';
    }

    /**
     * @param  $data 数据
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

    /**
     * @param  $id 主键id
     * 自动删除
     */
    public function delete($id)
    {
        $sql = "delete from $this->true_table WHERE $this->pk=".$id;
        //执行sql语句
        return $this->dao->exec($sql);
    }
    
    /**
     * @param  $data
     * @param  $where
     * 自动更新数据
     */
    public function update($data,$where=null)
    {
        //sql = "update ecm_goods set goods_name='name' where goods_id=100";
        //先判断是否有where条件
        if ( !$where ) {
            return false;//没有条件立即停止
        } else {
            foreach ($where as $k=>$v){
                $where_str = " WHERE `$k`='$v'";
            }
        }
        $sql = "UPDATE $this->true_table SET ";
        $fields= array_keys($data);
        $fields = array_map(function($v){
            return '`'.$v.'`';
        },$fields);

        //获取value值
        $fields_value = array_values($data);
        $fields_value = array_map(array($this->dao,'quote'),$fields_value);
        $str = '';//斌接数据
        foreach ( $fields as $k=>$v ) {
            $str .= $v.'='.$fields_value[$k].',';
        }
        $str = rtrim($str,',');
        $sql .= $str.$where_str;
        return $this->dao->exec($sql);
    }

    //自动查询
    //参数1：查询的字段列表 $data = array('goods_name','shop_price')
    //参数2：查询的条件 $where = array('goods_id'=>1)
    public function find($data=array(),$where=array())
    {
        //1. 先判断是否有字段
        if(!$data){
            //没有字段列表
            $fields = '*';
        }else{
            //有字段列表
            $fields = array_map(function($v){
                return '`'.$v.'`';
            },$data);
            $fields = implode(',', $fields);
        }
        //2. 确定查询的条件
        if(!$where){
            //没有where条件,查询所有数据
            $sql = "SELECT $fields FROM $this->true_table";
            //return $this->dao->fetchAll($sql);
        }else{
            foreach ($where as $k=>$v){
                $where_str = '`'.$k.'`='."'$v'";
            }
            //根据条件查询，返回1条数据
            $sql = "SELECT $fields FROM $this->true_table WHERE $where_str";
            // return $this->dao->fetchRow($sql);
        }
        die($sql);
    }
}
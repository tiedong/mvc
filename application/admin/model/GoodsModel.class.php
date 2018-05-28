<?php
namespace admin\model;
use framework\core\Model;

/*
 * 商品模型类，主要操作商品表的操作
 */
class GoodsModel extends Model
{
    //属性表名该模型操作的是哪一张数据表
    protected $logic_table = 'admin';
    //查询用户
    public function user_select()
    {
        $sql = "SELECT * FROM blog_user";
        return $this->dao->fetchAll($sql);
    }
}
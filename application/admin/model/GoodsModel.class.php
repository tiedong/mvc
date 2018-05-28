<?php
namespace admin\model;
use framework\core\Model;

/*
 * 商品模型类，主要操作商品表的操作
 */
class GoodsModel extends Model
{    
    //查询用户
    public function user_select()
    {
        $sql = "SELECT * FROM blog_user";
        return $this->dao->fetchAll($sql);
    }
}
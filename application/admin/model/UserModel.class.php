<?php
namespace admin\model;
use framework\core\Model;
/*
 * 用户模型类，主要操作用户表的操作
 */

class UserModel extends Model
{        
    
    //增加一个用户
    public function user_add(){        
        $sql = "INSERT INTO user VALUES(null,'admin','admin123')";
        $resulkt = $this->dao -> exec($sql);
        return $resulkt;
    }
    //删除一个用户
    public function user_delete(){}
    //修改一个用户
    public function user_update(){}
    //查询一个用户
    public function user_select(){}
}
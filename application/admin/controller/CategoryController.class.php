<?php
namespace admin\controller;
use framework\core\Controller;
use framework\core\Factory;
/*
 * 分类控制器类，主要负责分类管理这个功能模块
 */
class CategoryController extends Controller
{
    
    //查询分类列表
    public function indexAction(){
        //命令模型查询数据
        $model = Factory::M('admin\model\GoodsModel');
        $model->insert(array('goods_name'=>'i7'));
        die("sc");
        //查询分类列表
        $cat_list = $model -> user_select();
        var_dump($cat_list);
        exit;
        //命令视图显示数据
        //使用 smarty将分类列表的数据分配过去            
        $this->smarty -> assign('cat_list',$cat_list);
        $this->smarty -> display('goods_list.tpl');
    }
    
    //删除分类
    public function deleteAction(){}
    
    //修改分类
    public function editAction(){}
    
    //增加分类
    public function addAction(){
        
    }
}
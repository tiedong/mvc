<?php
/*
 * 分类控制器类，主要负责分类管理这个功能模块
 */
require_once '../../../framework/core/Controller.class.php';
class CategoryController extends Controller
{
    
    //查询分类列表
    public function indexAction(){
        //命令模型查询数据
        require_once '../../../framework/core/Factory.class.php';
        $model = Factory::M('CategoryModel');
        //查询分类列表
        $cat_list = $model -> cat_select();        
        //命令视图显示数据
        //使用 smarty将分类列表的数据分配过去            
        $this->smarty -> assign('cat_list',$cat_list);
        $this->smarty -> display('view/cat_list.html');
    }
    
    //删除分类
    public function deleteAction(){}
    
    //修改分类
    public function editAction(){}
    
    //增加分类
    public function addAction(){}
}
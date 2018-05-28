<?php
namespace framework\core;

class Framework
{
    //在构造方法中初始化
    public function __construct()
    {
        //定义路径常量
        $this->initConst();
        
        $this->autoload();
        //加载配置文件
        $config1 = $this->loadFrameworkConfig();
        $config2 = $this->loadCommonConfig();
        $GLOBALS['config'] = array_merge($config1,$config2);
        
        $this->initMCA();
        //因为该方法中使用的MODULE常量是在initMCA中定义的
        $config3 = $this->loadModuleConfig();
        $GLOBALS['config'] = array_merge($GLOBALS['config'],$config3);       
        
        $this->dispatch();
    }
    //路径常量
    private function initConst()
    {
        //项目所在的根目录
        define('ROOT_PATH', str_replace('\\', '/', getcwd().'/'));
        //项目的目录
        define('APP_PATH', ROOT_PATH.'application/');
        //框架的目录
        define('FRAMEWORK_PATH',ROOT_PATH.'framework/');
    }
    
    
    //注册自动加载
    public function autoload()
    {
        //说明：如果一个函数的参数是回调函数，就直接写函数的名字
        //如果函数的参数是一个对象的方法的话，需要传递数组进去，参数1：对象；参数2：对象的方法
        spl_autoload_register(array($this,"autoloader"));        
    }
    //自动加载执行的函数
    public function autoloader($className)
    {
        echo '我们需要:'.$className.'<br>';
        //针对第三方的类，做一个特例处理
        if($className=='Smarty'){
            require_once './framework/vendor/smarty/Smarty.class.php';
            return;
        }
        //1. 先将带有命名空间的类，分隔开
        $arr = explode('\\', $className);
    
        //2. 根据第一个元素确定加载的根目录
        if($arr[0] == 'framework'){
            $basic_path = './';
        }else{
            $basic_path = './application/';
        }
        //3. 确定application、framwork里面的子目录
        $sub_path = str_replace('\\', '/', $className);
    
        //4. 确定文件名
        //确定后缀：类文件的后缀：.class.php，接口文件的后缀是：.interface.php
        //framework\dao\I_DAO,判断最后元素是否是I_开头
        if(substr($arr[count($arr)-1], 0,2)=='I_'){
            //说明是接口文件
            $fix = '.interface.php';
        }else{
            $fix = '.class.php';
        }
        $class_file = $basic_path.$sub_path.$fix;
    
        //5. 加载类
        //如果不是按照我们的命名空间的规则定义的，说明不是我们需要加载的类，不用加载
        if(file_exists($class_file)){
            require_once $class_file;
        }
    }
   
    //确定mca
    public function initMCA()
    {
        //前台还是后台？
        $m = isset($_GET['m'])?$_GET['m']:$GLOBALS['config']['default_module'];
        define('MODULE', $m);
        
        //访问哪个控制器
        $c = isset($_GET['c'])?$_GET['c']:$GLOBALS['config']['default_controller'];
        define('CONTROLLER', $c);
        
        //访问控制器的哪个操作
        $a = isset($_GET['a'])?$_GET['a']:$GLOBALS['config']['default_action'];
        define('ACTION', $a);
    }
    
    //实例化对象，调用方法
    public function dispatch()
    {
        $controller_name = MODULE.'\controller\\'.CONTROLLER.'Controller';
        
        //先加载控制器类，再实例化对象
        $controller = new $controller_name;
        
        //调用控制器的方法
        $a = ACTION;
        $controller -> $a();
    }
    
    //加载框架的配置文件
    private function loadFrameworkConfig()
    {
        $config_file = './framework/config/config.php';
        return require_once $config_file;
    }
    //加载公共的配置文件
    private function loadCommonConfig()
    {
        $config_file = './application/common/config/config.php';
        //由于公共的配置文件可能没有,没有的时候就返回空数组
        if(file_exists($config_file)){
           return require_once $config_file; 
        }else{
            return array();
        }        
    }
    //加载具体模块（前台、后台）的配置文件    
    private function loadModuleConfig()
    {
        $config_file = './application/'.MODULE.'/config/config.php';
        //由于公共的配置文件可能没有,没有的时候就返回空数组
        if(file_exists($config_file)){
            return require_once $config_file;
        }else{
            return array();
        }
    }
    
    
}
<?php
//先提供自动加载机制

//注册一个自动加载
//参数就是当触发自动加载机制时，调用的回调函数，并且会把需要的类名传递到该函数中
spl_autoload_register("autoloader");

function autoloader($className)
{
    echo '需要:'.$className.'<br>';
    //将需要的类加载进来
}
new Beauty();

Handsom::getMoney();

class Handsom extends People
{
    
}
class DAOPDO implements I_DAO
{
    
}
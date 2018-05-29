<?php
/* Smarty version 3.1.30, created on 2018-05-28 22:54:39
  from "D:\phpStudy\WWW\mvc\application\admin\view\goods_list.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b0c182f47d7d8_38890345',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'db9b5e769b44ba87ac49448450cc8de0e1632170' => 
    array (
      0 => 'D:\\phpStudy\\WWW\\mvc\\application\\admin\\view\\goods_list.tpl',
      1 => 1501458217,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b0c182f47d7d8_38890345 (Smarty_Internal_Template $_smarty_tpl) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cat_list']->value, 'v');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
?>
	<?php echo $_smarty_tpl->tpl_vars['v']->value['goods_name'];?>
<br>
<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

<link href="css/style.css">

<style>
	a{text-decoration:none}
</style>


<a style="text-decoration:none">

<a style="text-decoration:none">

<a style="text-decoration:none"><?php }
}

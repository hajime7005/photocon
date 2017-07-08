<?php
/* Smarty version 3.1.30, created on 2017-07-09 05:38:29
  from "C:\xampp\htdocs\photocon\smarty\templates\smartMypage.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_596142c5459119_28054642',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '273dc6ba3f57ad649d0307aab8cb8e8bd60bae2e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\photocon\\smarty\\templates\\smartMypage.tpl',
      1 => 1499420884,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_596142c5459119_28054642 (Smarty_Internal_Template $_smarty_tpl) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>マイページ</title>
</head>
<body>

    <p>ようこそ！<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</p>
    <a href="upload.tmp">写真を投稿する。</a><BR>

</body>
</html><?php }
}

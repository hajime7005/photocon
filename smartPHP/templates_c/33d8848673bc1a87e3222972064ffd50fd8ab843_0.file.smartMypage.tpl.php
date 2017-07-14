<?php
/* Smarty version 3.1.30, created on 2017-07-14 17:08:35
  from "F:\xampp\htdocs\photocon\smarty\templates\smartMypage.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5968de73e60733_18375971',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '33d8848673bc1a87e3222972064ffd50fd8ab843' => 
    array (
      0 => 'F:\\xampp\\htdocs\\photocon\\smarty\\templates\\smartMypage.tpl',
      1 => 1500044911,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5968de73e60733_18375971 (Smarty_Internal_Template $_smarty_tpl) {
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
    <a href="../php/upload.html">写真を投稿する。</a><BR>

</body>
</html><?php }
}

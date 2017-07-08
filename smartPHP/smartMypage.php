<?php

session_start();

//define('_ROOT_DIR', __DIR__ . '/');
//require_once '../smarty/init.php';
//require_once '../smarty/libs/Smarty.class.php';

require_once(realpath(__DIR__) . "/../smarty/libs/Autoloader.php");
Smarty_Autoloader::register();


$smarty  = new Smarty;
/*
$smarty->template_dir = _SMARTY_TEMPLATES_DIR;
$smarty->compile_dir  = _SMARTY_TEMPLATES_C_DIR;
$smarty->config_dir   = _SMARTY_CONFIG_DIR;
$smarty->cache_dir    = _SMARTY_CACHE_DIR;
*/
$smarty->assign("name", $_SESSION['nickname']);

$file = '../smarty/templates/smartMypage.tpl';

$smarty->display($file);
?>

<?php
require_once (__DIR__.'/init_auth.php');

//管理者登録
//テンプレを指定して出力
error_reporting(E_ALL & ~E_NOTICE);
$smarty_obj->display('admin/register_admin.tpl');
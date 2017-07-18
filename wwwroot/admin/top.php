<?php

require_once (__DIR__.'/init_auth.php');

//テンプレを指定して出力
error_reporting(E_ALL & ~E_NOTICE);
$smarty_obj->display('admin/top.tpl');
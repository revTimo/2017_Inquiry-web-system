<?php

require_once(__DIR__.'/../init.php');

//templateに指定
error_reporting(E_ALL & ~E_NOTICE);
$smarty_obj->display('admin/index.tpl');

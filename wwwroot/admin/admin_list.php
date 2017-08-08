<?php

require_once (__DIR__.'/init_auth.php');

//管理者一覧処理
$dbh = get_dbh();
$sql = 'SELECT * FROM admin_users';
$pre = $dbh->prepare($sql);
$r = $pre->execute();
$result = $pre->fetchAll(PDO::FETCH_COLUMN);
$admin_list = [];
//var_dump($result); exit;
//管理者テーブルからデータ取得して$admin_listに入れる
foreach ($result as $key => $value) {
	$admin_list[$key] = $value;
}
/*var_dump($admin_list);
exit;*/
$smarty_obj->assign('admin_list',$admin_list);
//テンプレを指定して出力
error_reporting(E_ALL & ~E_NOTICE);
$smarty_obj->display('admin/admin_list.tpl');
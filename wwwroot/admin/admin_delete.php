<?php
require_once(__DIR__.'/../init.php');
require_once(__DIR__.'/../dbh.php');
ob_start();
//管理者一覧処理
$dbh = get_dbh();

//複数の管理者を削除
if ($_GET['request'] === 'remove_multiple') {
	$ids = $_POST['admin_ids'];
	foreach ($ids as $value) {
		$sql = "DELETE from admin_users WHERE admin_user_id=:id";
		$pre = $dbh->prepare($sql);
		$r = $pre -> bindValue(":id",$value);
		$r = $pre->execute();
	}
}

//管理者一人だけを削除
if ($_GET['request'] === 'remove_single') {
	$id = $_GET['admin_id'];
	$sql = "DELETE from admin_users WHERE admin_user_id=:id";
	$pre = $dbh->prepare($sql);
	$r = $pre -> bindValue(":id",$id);
	$r = $pre->execute();
}

header("Location:admin_list.php");
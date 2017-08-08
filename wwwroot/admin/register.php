<?php
require_once(__DIR__.'/../init.php');
require_once(__DIR__.'/../dbh.php');
ob_start();

//画面入力のIDとパスワードを取得
$id = (string)@$_POST['admin_id'];
$pw = (string)@$_POST['admin_password'];

//入力validate
if (('' === $id)||('' === $pw)) {	
	echo"入力してください";
	exit;
}

//DBハンドルを取得
$dbh = get_dbh();

$sql = "INSERT INTO admin_users (admin_user_id, password)
    VALUES (:user_id, :user_password)";
$pre = $dbh->prepare($sql);
$pre -> bindValue(':user_id',$id);
$pre -> bindValue(':user_password',password_hash($pw, PASSWORD_DEFAULT));
$pre -> execute();
if (false === $pre) {
	//エラー処理
	//本当は別のページを作る
	echo 'DBにエラーが発生しました';
	echo $pre->errorInfo();
	exit;
}

header("Location:admin_list.php");
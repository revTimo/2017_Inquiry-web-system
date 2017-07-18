<?php

//認証を行う

//共通エラー関数
function error () {
	//XXX後でエラーメッセージ
	header('Location: ./index.php');
	exit;
}


ob_start();

require_once(__DIR__.'/../init.php');

require_once(__DIR__.'/../dbh.php');

//画面入力のIDとパスワードを取得
$id = (string)@$_POST['id'];
$pw = (string)@$_POST['password'];
//var_dump($id, $pw); exit;
//軽くValidate
if (('' === $id)||('' === $pw)) {
	//エラー処理の関数	
	error();
}

//DB中のIDとパスワードを取得
//DBハンドルを取得
$dbh = get_dbh();
//var_dump($dbh); exit;

//select 発行して
//--
//プリペアードステートメント
$sql = 'SELECT * FROM admin_users WHERE admin_user_id = :admin_user_id';
$pre = $dbh->prepare($sql);
//バインド
$pre->bindValue(':admin_user_id',$id);
//実行
$r = $pre->execute();
if (false === $r) {
	//エラー処理
	//本当は別のページを作る
	echo 'DBにエラーが発生しました';
	echo $pre->errorInfo();
	exit;
}
//データを取得
$admin_user = $pre->fetch(PDO::FETCH_ASSOC);
//var_dump($admin_user); exit;

if (false === $admin_user) {
	//エラー処理の関数	
	error();
}

//IDとパスワードを比較して、認証OKなら
$r = password_verify($pw, $admin_user['password']);
/*var_dump($r); 
exit;*/
if (false === $r) {
	//エラー処理の関数	
	error();
}

//認証OKなら
//認可用の準備をする
session_regenerate_id(true);//弱対策：順番大事
$_SESSION['admin_auth']['admin_user_id'] = $id;

//ログイン後の管理画面TopPageに移動
header('Location: ./top.php');

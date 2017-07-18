<?php

require_once (__DIR__.'/init_auth.php');

//取得したい問い合わせ番号
$inquiry_id = (string)@$_GET['inquiry_id'];
//$inquiry_id = $_GET['inquiry_id']??'';//PHP7以降

//軽くvalidate
if ('' === $inquiry_id){
	//XXX listにずっと飛ばす
	header('Location: ./inquiry_list.php');
	exit;
}

//DBから「問い合わせ詳細情報」を取得する
//prepare statemate 
$dbh = get_dbh();

$sql = 'SELECT * FROM inquirys WHERE inquiry_id = :inquiry_id';
$pre = $dbh->prepare($sql);
//bind value
$pre->bindValue(':inquiry_id',$inquiry_id);
//sql実行
$r = $pre->execute();
//データを取得
$data = $pre->fetch(PDO::FETCH_ASSOC);
//var_dump($data);

if(false === $data) {
	header('Location: ./inquiry_list.php');
	exit;
}

$smarty_obj->assign('inquiry_data',$data);

//テンプレートを指定して、出力
error_reporting(E_ALL & ~E_NOTICE);
$smarty_obj->display('admin/inquiry_detail.tpl');
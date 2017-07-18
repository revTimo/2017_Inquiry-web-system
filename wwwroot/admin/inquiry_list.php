<?php

require_once (__DIR__.'/init_auth.php');

//ページ数取得
$page_num = (int)@$_GET['p'];
//1Pageあたりに要素数
$per_page = 10;


//sort情報を取得する
$sort = (string)@$_GET['sort'];
//var_dump($sort);
//軽くvalidate

//空文字ならデフオルト値に調整しておく
$sort_white_list = [
	'id' => 'inquiry_id',
	'id_desc' => 'inquiry_id DESC',
	'response_date' =>'response_date',
	'response_date_desc' => 'response_date DESC',
];
//
if ( ('' === $sort) || (false === isset($sort_white_list[$sort])) ) {
	//ホワイトリストにない、カラ文字ならデフォルト値にしておく
	$sort = 'id_desc';
}

$sort_sql_e = $sort_white_list[$sort];
$smarty_obj->assign('sort',$sort); //ソート条件を渡しておく
//var_dump($sort_sql_e);
//var_dump($sort);

//検索ワードを取得する
$find_string = []; //「検索文字列保存用」
foreach (['name','email','birthday_from','birthday_to'] as $p) {
		$find_string[$p] = (string)@$_GET[$p];
}
//var_dump($find_string);
$smarty_obj->assign('find_string',$find_string);
//「ソート順番を変えるとき」用のＵＲＩ作成
//XXX foreachを、本当はまとめると、よりよい
$awk = [];
foreach ($find_string as $key => $v) {
	if ('' !== $find_string[$key]) {
		$awk[] = "{$key}=". rawurldecode($find_string[$key]);
	}
}
var_dump($awk);
$uri_params = implode('&', $awk);
var_dump($uri_params);
//一覧をDBから取得して
$dbh = get_dbh();
//
$bind_data = [];
$where_array = [];
// プリペアドステートメント
$sql = 'SELECT * FROM inquirys ';
$sql_count = 'SELECT count(inquiry_id) FROM inquirys';

// SQLを動的に追加

if ('' !== $find_string['email']) {
		$where_array[] = ' email=:email ';
		$bind_data[':email'] = $find_string['email'];
}
// XXX nameの検索(LIKE句)
if ('' !== $find_string['name']) {
		$where_array[] = 'name LIKE :name';
//LIKE用のエスケープ処理
		$name_e = str_replace(['\\'  , '%'  , '_'], ['\\\\', '\\%', '\\_'],
			$find_string['name']); 
		$bind_data[':name'] = "{$find_string['name']}%";
}

// XXX birthdayの検索(範囲検索 BETWEEN)
if ('' !== $find_string['birthday_from']) {
		if (''!== $find_string['birthday_to']) {
		//bd_from ari, bd_to ari
			$where_array[] = ' birthday BETWEEN :birthday_from AND :birthday_to ';
			$bind_data[':birthday_from'] = $find_string['birthday_from'];
			$bind_data[':birthday_to'] = $find_string['birthday_to'];
		}else {
		//bd_from ari, bf_to nashi
			$where_array[] = ' birthday >= :birthday_from';
			$bind_data[':birthday_from'] = $find_string['birthday_from'];
		}
}else if ('' !== $find_string['birthday_to']) {
		//bd_from nashi, bd_to ari
		$where_array[] = ' birthday <= :birthday_to';
		$bind_data[':birthday_to'] = $find_string['birthday_to'];
} 

//Whereの作成
if (array() !== $where_array) {
		//$sql .=' WHERE '.implode(' and ', $where_array);
	$buf = ' WHERE '.implode(' and ', $where_array);
	$sql .= $buf;
	$sql_count .= $buf;
}


// SQLの締め
//$sql = $sql . ' ORDER BY inquiry_id DESC;';
$sql .= " ORDER BY {$sort_sql_e} LIMIT :limit_start, :limit_num;";
$sql_count .= ";";

//count用のbind_dataを保存しておく
$bind_data_count = $bind_data;

$bind_data[':limit_start'] = $page_num * $per_page;
$bind_data[':limit_num'] = $per_page;	

$pre = $dbh->prepare($sql);
//var_dump($sql);
//var_dump($pre);
//var_dump($dbh->errorInfo());

// 値のバインド
foreach($bind_data as $k => $v) {
    $pre->bindValue($k, $v);
}

$r = $pre->execute(); //XXX エラーチェック省略

//データを取得
$data = $pre->fetchAll(PDO::FETCH_ASSOC);
//var_dump($data);

//レコード数をカウントする（ダミー）
$sql = 'SELECT count(inquiry_id) FROM inquirys;';
$pre = $dbh->prepare($sql);
$r = $pre->execute();
$rec_num = $pre->fetchAll();
var_dump($rec_num);	

//テンプレートにデータを渡す
$smarty_obj->assign('inquiry_list',$data);

//レコード数をカウントする
$pre_count = $dbh->prepare($sql_count);
//bind
foreach ($bind_data_count as $k => $v) {
	$pre_count->bindValue($k, $v);
}
//SQL実行
$r = $pre_count->execute(); //XXXエラーチェック省略
//レコード数件を取得
$rec_num = $pre_count->fetchAll();
$rec_num = $rec_num[0][0];
var_dump($rec_num);

//最大Pageの計算
$max_page_num = celi($rec_num / $per_page);
var_dump($max_page_num);

//[前ページ]と「次のページ」のページ数を設定
$smarty_obj->assign('next_page',$page_num +1);
$smarty_obj->assign('back_page',$page_num -1);
//ボタン制御
$smarty_obj->assign('back_page_flg',(0===$page_num)? false : true);
$smarty_obj->assign('next_page_flg',($page_num >= $max_page_num)? false : true);

//表示する
//テンプレを指定して出力
error_reporting(E_ALL & ~E_NOTICE);
$smarty_obj->display('admin/inquiry_list.tpl');
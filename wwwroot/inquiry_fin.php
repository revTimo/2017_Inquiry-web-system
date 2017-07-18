<?php
//var_dump($_POST);
//headerを出したら
require_once(__DIR__.'/init.php');
//
require_once(__DIR__. '/dbh.php');

$params = [
	'email','name','birthday','body'
];
$input_data = [];
foreach($params as $p) {
	$input_data[$p] = (string)@$_POST[$p];
}

//var_dump($input_data);

//validate（情報正しい？）
$error_detail = [];

//csrfチェック
//tokenの存在確認（check exists）
$posted_token = $_POST['csrf_token'];
if (false == isset($_SESSION['csrf_token'][$posted_token])) {
	//error detail
	$error_detail['error_csrf_token'] = true;
}else {
		$ttl = $_SESSION['csrf_token'][$posted_token];
		//寿命確認
		if (time() >= $ttl + 60) {
			//token作成から60秒以上経過しているのでNG
			$error_detail['error_csrf_timeover']=time() . " >= {$ttl}";
		}
		unset($_SESSION['csrf_token'][$posted_token]);
	}

//tokenの寿命確認 (check life)


//必要チェック
$must_params = ['email','body'];
foreach ($must_params as $p) {
	if ('' === $input_data[$p]) {
		$error_detail["error_must_{$p}"] = true;
	}
}

if (false === filter_var($input_data['email'], FILTER_VALIDATE_EMAIL)) {
	$error_detail["error_format_email"] = true;
}

if ('' !== $input_data['birthday']) {
	if (false === strtotime($input_data['birthday'])) {
		$error_detail["error_format_birthday"] = true;
	}

}

//エラー判定
if ([] != $error_detail) {
	//error	内容を保存
	$_SESSION['buffer']['error_detail']=$error_detail;
	//入力情報をsessionに保存
	$_SESSION['buffer']['input'] = $input_data;
	//echo 'エラーがあったらしい';
	header('Location:./inquiry.php');	
exit;
}
//ダミー
//echo 'データのvalidatateはOKでした！！';

//入力された情報をDBにINSERT
//DBハンドルを取得
$dbh = get_dbh();

//ＳＱＬ文（準備された文）を作成
$sql = 'INSERT INTO inquirys(email, inquiry_body, name, birthday)
	VALUES(:email, :inquiry_body, :name, :birthday);';
$pre = $dbh->prepare($sql);

//データーをバインド
$pre->bindValue(':email',$input_data['email']);
$pre->bindValue(':inquiry_body',$input_data['body']);
$pre->bindValue(':name',$input_data['name']);
$pre->bindValue(':birthday',$input_data['birthday']);
//ＳＱＬ実行
$r = $pre->execute();
if (false == $r) {
	echo "データー取得できませんでした";
	exit;
}


error_reporting(E_ALL & ~E_NOTICE);
$smarty_obj->display('inquiry_fin.tpl');

?>

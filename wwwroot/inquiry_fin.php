<?php
//var_dump($_POST);
//headerを出したら
ob_start();
session_start();

$params = [
	'email','name','birthday','body'
];
$input_data = [];
foreach($params as $p) {
	$input_data[$p] = (string)@$_POST[$p];
}

var_dump($input_data);

$error_detail = [];

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
echo 'データのvalidatateはOKでした！！';
//入力された情報をDBにINSERT

//ありがとうページ
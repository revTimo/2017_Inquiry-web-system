<?php
//var_dump($_POST);

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


if ([] != $error_detail) {
	echo 'エラーがあったらしい';
	exit;
}

echo 'データのvalidatateはOKでした！！';
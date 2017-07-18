<?php

require_once(__DIR__ . '/init_auth.php');

//POST‚³‚ê‚½î•ñ‚ðŽæ“¾

$params = ['inquiry_id','response_body'];
$input_data =[];
foreach ($params as $p) {
	$input_data[$p] = (string)@$_POST[$p];
}

//Å’á‚Ìvalidate
if (('' === $input_data['inquiry_id']) or 
		('' === $input_data['response_body'])) {
			header('Location: inquiry_detail.php?inquiry_id='.rawurlencode($input_data['inquiry_id']));
			exit;
	
}
$dbh = get_dbh();
$sql = 'UPDATE inquirys
					SET status = 2,
							response_body = :response_body,
							response_date = :response_date
					WHERE inquiry_id = :inquiry_id;';
$pre = $dbh->prepare($sql);
//’lƒoƒCƒ“ƒh
$pre->bindValue(':response_body', $input_data['response_body']);
$pre->bindValue(':response_date', date('Y-m-d H:i:s'));
$pre->bindValue(':inquiry_id', $input_data['inquiry_id']);
//XXXXSQLŽÀs
//2017-07-04‚Ü‚Å
$r = $pre->execute();//XXXエラーcheck省略
//detailに移動
header('Location: inquiry_detail.php?inquiry_id='.rawurlencode($input_data['inquiry_id']));
//[•ÔMî•ñ]‚ðDB‚ÉUPDATE
//detail‚ÉˆÚ“®
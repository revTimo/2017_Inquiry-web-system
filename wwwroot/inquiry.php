<?php

ob_start();
session_start();

//var_dump($_SESSION);

//入力内容を取得
//$input = $_SESSION['buffer']['input'];
if (true === isset($_SESSION['buffer']['input'])) {
	$input = $_SESSION['buffer']['input'];
}else {
	$input = array();
}

//error内容を取得
//$error_detail = $_SESSION['buffer']['error_detail'];
if (true === isset($_SESSION['buffer']['error_deatil'])) {
	$error_detail = $_SESSION['buffer']['error_detail'];
}else {
	$error_detail = array();
}

//XSS対策関数
function h($a) {
	return htmlspecialchars($a, ENT_QUOTES);
}
?>
<html>
<body>
<?php
	if (0 < count($error_detail)) {
		echo '<div style="color:red;">エラーがありました。</div>';
	}
?>

<?php
	if (isset($error_detail['error_must_email'])) {
		echo '<div style="color:red;">メアドが必要です。</div>';
	}
?>
	<form action="./inquiry_fin.php" method="post">
		emailアドレス（＊）：<input type="text" name="email"
			value="<?php echo h(@$input['email']); ?>"><br>

		名前：<input type="text" name="name" 
			value="<?php echo h(@$input['name']); ?>"><br>

		誕生日：<input type="text" name="birthday"
			value="<?php echo h(@$input['birthday']); ?>"><br>

		問い合わせ内容：<textarea name="body"
			value="<?php echo h(@$input['body']); ?>"></textarea><br>
		<button>問い合わせる</button>
	</form>
</body>
</html>


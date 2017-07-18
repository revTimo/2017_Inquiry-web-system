<html>
<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

</head>
<body>
<div class="container">

<table class="table">

<tr>
	<td>id
	<td>{$inquiry_data.inquiry_id}
</tr>

<tr>
	<td>ステータス
	<td>{if 0 == $inquiry_data.status}未返信{/if}
			{if 1 == $inquiry_data.status}返信作業中{/if}
			{if 2 == $inquiry_data.status}返信済{/if}
</tr>

<tr>
	<td>email
	<td>{$inquiry_data.email}
</tr>

<tr>
	<td>name
	<td>{$inquiry_data.name}
</tr>

<tr>
	<td>birthday
	<td>{$inquiry_data.birthday}
</tr>

<tr>
	<td>body
	<td>{$inquiry_data.inquiry_body}
</tr>

<tr>
	<td>返信日時
	<td>{$inquiry_data.response_date}
</tr>

<tr>
	<td>返信内容
	<td><pre>{$inquiry_data.response_body}</pre>
</table>

<h2>返信内容を登録</h2>
<form action="./inquiry_edit.php" method="POST">
<input type="hidden" name="inquiry_id" value="{$inquiry_data.inquiry_id}">
返信内容<textarea name="response_body"></textarea><br>
<button class="btn btn-primary">返信内容を登録する</button>
</form>

<h2>未実装</h2>
<ul>
	<li>「返信をメールする」機能
	<li>返信のステータス表示
</ul>

<a href="./top.php">Topに戻る</a>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</div>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<title></title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<body>
<div class="container">
<h1>管理者一覧</h1>
<a href="register_admin.php">管理者登録</a><br>

<!-- チェックボックスをチェックしないと削除ボタンが効かないように -->
<script>
$(function(){
	$('.checkbox').click(function(){
		$('#off').prop('disabled', !$('.checkbox:checked').length);
	})
})
</script>


<!-- 複数削除フォウム -->
<form action="admin_delete.php?request=remove_multiple" method="POST">
<!-- 管理者一覧テーブル表示 -->
<table class="table table-hover">
<tr>
<th>no</th>
<th>管理者ID</th>
<th>削除</th>
</tr>
{foreach from=$admin_list key=k item=v}
<tr>
	<td><input type="checkbox" name="admin_ids[]" value="{$v}" class="checkbox">{$k+1}</td>
	<td>{$v}</td>
	<td><a href="admin_delete.php?admin_id={$v}&request=remove_single"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>
</tr>
{/foreach}
</table>
<button type="submit" name="multi_delete_btn" disabled class="btn btn-danger" id="off">選択したものを削除</button><br><br>
</form>

<a href="top.php" type="button" class="btn btn-primary">トップに戻る</a>
<a href="./logout.php" type="button" class="btn btn-primary">ログアウト</a>


</div>
</body>
</html>
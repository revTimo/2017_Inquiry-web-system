<html>
<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<style type="text/css">
	body {
		background-color: #ccc;
	}
</style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Inquiry</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="./top.php">Top</a></li>
      <li><a href="./admin_list.php">管理者</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="./logout.php"><span class="glyphicon glyphicon-log-in"></span> ログアウト</a></li>
    </ul>
  </div>
</nav>

<div class="container">

<h1>問い合わせ一覧</h1>
<div class="panel panel-primary">
<div class="panel-heading">検索</div>
<div class="panel-body">
<div class="col-xs-3">
	<form action="./inquiry_list.php" method="GET">
	<input type="hidden" name="sort" value="{$sort}" class="form-control">
	<div class="input-group">
	<span class="input-group-addon"><i class="glyphicon glyphicon-user">
	</i></span>
	<input name="name" value="{$find_string.name}" class="form-control" placeholder="name(あいまい)">
	</div>
	<div class="input-group">
	<span class="input-group-addon"><i class="glyphicon glyphicon-envelope">
	</i></span>
	<input name="email" value="{$find_string.email}" class="form-control" placeholder="abc@gmail.com">
	</div>
	<div class="input-group">
	<span class="input-group-addon"><i class="glyphicon glyphicon-calendar">
	</i></span>
	<input name="birthday_from" value="{$find_string.birthday_from}" class="form-control" placeholder="誕生日">~
	<input name="birthday_to" value="{$find_string.birthday_to}" class="form-control"　placeholder="誕生日">
	</div>
	<button type="submit" class="btn btn-primary btn-xs">検索</button>
	</form>
</div>
</div>
</div>


<div class="panel panel-primary">
<div class="panel-heading">一覧</div>
<div class="panel-body">
<div class="btn-group">
{if $back_page_flg == true}
	<a href="inquiry_list.php?sort={$sort}&{$uri_params|unescape}&p={$back_page}" class="btn btn-primary">back</a>
{else}

{/if}
{if $next_page_flg == true}
	<a href="inquiry_list.php?sort={$sort}&{$uri_params|unescape}&p={$next_page}" class="btn 
	btn-primary">next</a>
{else}

{/if}
</div>

<table class="table table-hover">
<tr>
	<th>ID<a href="./inquiry_list.php?sort=id&{$uri_params|unescape}">▲</a><a href="./inquiry_list.php?sort=id_desc&{$uri_params|unescape}">▼</a>
	<th>名前<a href="">▲</a><a href="">▼</a>
	<th>email<a href="">▲</a><a href="">▼</a>
	<th>問い合わせ
	<th>返信日時<a href="./inquiry_list.php?sort=response_date&{$uri_params|unescape}">▲</a><a href="./inquiry_list.php?sort=response_date_desc&{$uri_params|unescape}">▼</a>
	<th>問い合わせ内容
	<th>

{foreach from=$inquiry_list item=i}
	<tr>	
		<td>{$i.inquiry_id}
		<td>{$i.name}
		<td>{$i.email}
		<td>{$i.inquiry_body}
		<td>{$i.response_date}
		<td><a href="./inquiry_detail.php?inquiry_id={$i.inquiry_id|urlencode}" class="btn btn-normal">問い合わせ詳細</a>
	</tr>
{/foreach}
</table>
<a href="./top.php" class="btn btn-primary btn-md">Topに戻る</a>
</div>
</div>
</div>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</div>
</body>
</html>
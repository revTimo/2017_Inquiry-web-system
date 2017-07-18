<html>

<body>

{if 0 < $error_detail_count}
	<div style="color: red;">エラーがあります</div>
{/if}

{if true == $error_detail.error_must_email}
	<div style="color: red;">メアドは必須です。</div>
{/if}

{if true == $error_detail.error_csrf_token}
	<div style="color: red;">トクーンエラー。</div>
{/if}

{*
error_must_body
error_format_email
error_format_birthday
*}

  <form action="./inquiry_fin.php" method="post">
    emailアドレス(*):<input type="text" name="email"
        value="{$input.email}"><br>

    名前:<input type="text" name="name"
        value="{$input.name}"><br>

    誕生日:<input type="text" name="birthday"
        value="{$input.birthday}"><br>

    問い合わせ内容<textarea name="body">
{$input.body}</textarea><br>
		
		<input type="hidden" name="csrf_token" 
					value="{$csrf_token}">
    <button>問い合わせる</button>
  </form>
</body>
</html>


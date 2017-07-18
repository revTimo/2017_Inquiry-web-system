<?php

require_once (__DIR__.'/../init.php');
require_once (__DIR__.'/../dbh.php');
//アクセス制御：ログインしてなかったらいれない
if (false === isset($_SESSION['admin_auth'])) {
	header('Location: ./index.php');
	exit;
}

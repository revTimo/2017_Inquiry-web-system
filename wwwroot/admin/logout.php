<?php

require_once (__DIR__.'/../init.php');

//session中のログイン情報を廃棄
unset($_SESSION['admin_auth']);

//index に移動
header('Location: ./index.php');
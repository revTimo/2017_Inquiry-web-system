<?php

//初期処理プログラム

//session開始
ob_start();
session_start();

//smarty設定
require_once(__DIR__.'/smarty_init.php');
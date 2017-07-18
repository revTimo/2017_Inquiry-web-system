<?php

$raw_pass = 'password';
$t_start = microtime(true);
$pass = password_hash($raw_pass, PASSWORD_DEFAULT);
var_dump($raw_pass, $pass);
$t_end = microtime(true);

//説明用コード
$t_start = microtime(true);
$pass_md5 = md5($raw_pass);
$t_end = microtime(true);
//var_dump('md5 is',);
$pass_sha1 = sha1($raw_pass);
var_dump($pass_md5,$pass_sha1);
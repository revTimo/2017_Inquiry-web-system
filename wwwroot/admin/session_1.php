<?php
ob_start();
session_start();

$r = mt_rand(1, 1000);
$_SESSION['rand'] = $r;
var_dump($_SESSION['rand']);
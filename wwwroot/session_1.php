<?php

ob_start();
session_start();

var_dump($_SESSION);

$_SESSION['rand']=mt_rand(0, 1000);

var_dump($_SESSION);


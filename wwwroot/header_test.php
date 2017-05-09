<?php
//headerの前に出力したい場合（一般はヘッダーの後に出力すること）
ob_start();

//少し待つ
sleep(2);

//余計な出力
echo "test";

//移動させる
header('Location:http://google.com');
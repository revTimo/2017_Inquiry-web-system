<?php

require_once (__DIR__.'/../init.php');

//session���̃��O�C������p��
unset($_SESSION['admin_auth']);

//index �Ɉړ�
header('Location: ./index.php');
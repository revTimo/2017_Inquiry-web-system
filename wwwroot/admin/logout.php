<?php

require_once (__DIR__.'/../init.php');

//session’†‚ÌƒƒOƒCƒ“î•ñ‚ð”pŠü
unset($_SESSION['admin_auth']);

//index ‚ÉˆÚ“®
header('Location: ./index.php');
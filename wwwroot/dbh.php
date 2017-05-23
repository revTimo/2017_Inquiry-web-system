<?php
require_once('db_config.php');

function get_dbh() {
    static $dbh = NULL;
    if (NULL !== $dbh) {
        return $dbh;
    }
    // データの設定
		$db_config = db_config();

    // XXX 実際は、configファイル等で外出しにする事が多い
    $user = $db_config['user'];
    $pass = $db_config['pass'];
    $dsn = "mysql:dbname={$db_config['database']};host={$db_config['host']};
						charset={$db_config['charset']}";

    // 接続オプションの設定
    $opt = array (
        PDO::ATTR_EMULATE_PREPARES => false,
    );
    // 「複文禁止」が可能なら付け足しておく
    if (defined('PDO::MYSQL_ATTR_MULTI_STATEMENTS')) {
        $opt[PDO::MYSQL_ATTR_MULTI_STATEMENTS] = false;
    }

    // 接続
    try {
        $dbh = new PDO($dsn, $user, $pass, $opt);
    } catch (PDOException $e) {
        // XXX 本当はもう少し丁寧なエラーページを出力する
        echo 'システムでエラーが起きました';
        exit;
    }
    //
    return $dbh;
}

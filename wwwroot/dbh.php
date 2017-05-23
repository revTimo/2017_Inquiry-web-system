<?php
require_once('db_config.php');

function get_dbh() {
    static $dbh = NULL;
    if (NULL !== $dbh) {
        return $dbh;
    }
    // �f�[�^�̐ݒ�
		$db_config = db_config();

    // XXX ���ۂ́Aconfig�t�@�C�����ŊO�o���ɂ��鎖������
    $user = $db_config['user'];
    $pass = $db_config['pass'];
    $dsn = "mysql:dbname={$db_config['database']};host={$db_config['host']};
						charset={$db_config['charset']}";

    // �ڑ��I�v�V�����̐ݒ�
    $opt = array (
        PDO::ATTR_EMULATE_PREPARES => false,
    );
    // �u�����֎~�v���\�Ȃ�t�������Ă���
    if (defined('PDO::MYSQL_ATTR_MULTI_STATEMENTS')) {
        $opt[PDO::MYSQL_ATTR_MULTI_STATEMENTS] = false;
    }

    // �ڑ�
    try {
        $dbh = new PDO($dsn, $user, $pass, $opt);
    } catch (PDOException $e) {
        // XXX �{���͂����������J�ȃG���[�y�[�W���o�͂���
        echo '�V�X�e���ŃG���[���N���܂���';
        exit;
    }
    //
    return $dbh;
}

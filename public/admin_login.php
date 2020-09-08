<?php  // admin_login.php

// 初期処理の読み込み
require_once('init.php');
require_once(BASEPATH . '/libs/AdminAuthentication.php');

// formからの情報を取得
$id = strval($_POST['id']) ?? '';
$pass = strval($_POST['id']) ?? '';
//
if (null === AdminAuthentication::login($id, $pass)) {
    // XXXX
    exit;
}

// XXX ok









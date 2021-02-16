<?php  // admin_login.php

// 初期処理の読み込み
require_once('init.php');
require_once(BASEPATH . '/libs/AdminAuthentication.php');

// formからの情報を取得
$id = strval($_POST['id']) ?? '';
$pass = strval($_POST['pw']) ?? '';
//
if (null === ($admin_obj = AdminAuthentication::login($id, $pass))) {
    //
    $_SESSION['admin']['flash']['authentication_error'] = true;
    $_SESSION['admin']['flash']['id'] = $id;
    
    // 入力画面に戻す
    header('Location: ./admin.php');
    exit;
}

// 以下、ログイン成功時の処理

// セッションIDを作り替える
session_regenerate_id(true);

// セッションに「認可用」の情報を入れる
$_SESSION['admin']['auth']['login_id'] = $admin_obj->login_id;

// ログイン後Topに遷移
//var_dump($_SESSION);
header('Location: ./admin_top.php');
















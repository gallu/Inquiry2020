<?php  // admin_top.php

// 初期処理の読み込み
require_once('init.php');

// 認可チェック
if (false === isset($_SESSION['admin']['auth'])) {
    header('Location: admin.php');
}

// 出力用の設定
$context = [];
$template_file_name = 'admin/admin_top.twig';

// 終了処理の読み込み
require_once('fin.php');


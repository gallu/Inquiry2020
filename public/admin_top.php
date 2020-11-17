<?php  // admin_top.php

// 初期処理の読み込み
require_once('init_admin_auth.php');
require_once(BASEPATH . '/libs/InquiryModel.php');

// お問い合わせの一覧を取得
$context = [];
$context['inquiry_list'] = InquiryModel::getList();
//var_dump($context);

// 出力用の設定
$template_file_name = 'admin/admin_top.twig';

// 終了処理の読み込み
require_once('fin.php');


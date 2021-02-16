<?php  // inquiry_detail_send.php
// 初期処理の読み込み
require_once('init_admin_auth.php');
require_once(BASEPATH . '/libs/InquiryModel.php');

// データの取得 + エラーチェック(validate)
$params = ['inquiry_id', 'reply_charge', 'reply_subject', 'reply_body' ];
$data = [];
$error_messages = [];
foreach($params as $p) {
    if ('' === ($data[$p] = strval($_POST[$p] ?? ''))) {
        $error_messages[] = "{$p}は必須項目です";
    }
}
//var_dump($data, $error_messages);
if ([] !== $error_messages) {
    // XXX
    var_dump($error_messages);
    exit;
}

$model = InquiryModel::find($data['inquiry_id']);
//var_dump($model);
// エラーチェック(model)
if (null === $model) {
    // XXX
    echo 'えねよ！！';
    exit;
}

// エラーチェック(未送信か？)
//var_dump($model->get());
if (null !== $model->reply_at) {
    // XXX
    echo "すでに返信済みです\n";
    exit;
}

// mail送信
// メール本体を作る
$from = 'inquiry@example.com'; // XXX 本当はどこかconfigファイルにでも
$message = (new Swift_Message($data['reply_subject']))
    ->setFrom($from)
    ->setTo($model->email)
    ->setBody($data['reply_body'])
    ;
//var_dump($message);

// 送信する
/*
$smtp = new Swift_SmtpTransport('localhost', 25); // XXX 本当はどこかconfigファイルにでも
//var_dump($smtp);
$r = (new Swift_Mailer($smtp))->send($message);
var_dump($r);
// XXX 戻り値はboolではなくint
if (0 === $r) {
    // XXX
    echo 'メールが上手く送れなかったよ？';
    exit;
}
*/

// データの更新
foreach($params as $p) {
    // pkは更新しない
    if ('inquiry_id' === $p) {
        continue;
    }
    //
    $model->$p = $data[$p];
}
//
$model->reply_at = date('Y-m-d H:i:s');
//$model->reply_at = (new DateTime())->format('Y-m-d H:i:s'); // こっちでもよい
//var_dump($model->get());
//
$r = $model->update();
if (false === $r) {
    // XXX
    echo 'updateで失敗しました orz';
    var_dump(DbHandle::get()->errorInfo());
    exit;
}

// 詳細画面に移動
header('Location: inquiry_detail.php?inquiry_id=' . rawurldecode($model->inquiry_id));




<?php  // inquiry_fin.php
// 初期処理の読み込み
require_once('init.php');
require_once(BASEPATH . '/libs/InquiryModel.php');

if (true === isset($_SESSION['inquiry_data'])) {
    //
    $inquiry = new InquiryModel();
    $params = ['name', 'email', 'body'];
    foreach($params as $s) {
        $inquiry->$s = $_SESSION['inquiry_data'][$s];
    }
    $inquiry->created_at = date('Y-m-d H:i:s');
    $r = $inquiry->insert(); // XXX
//var_dump($r); exit;
/*
    // 入力された情報をテーブルに書き込む
    $dbh = DbHandle::get(); // PDO

    // プリペアドステートメント(準備された文)を作成
    $sql  = 'INSERT INTO inquiry(name, email, body, created_at)
                    VALUES(:name, :email, :body, :created_at);';
    $pre = $dbh->prepare($sql);
    //var_dump($pre);

    // プレースホルダに値をバインド
    $pre->bindValue(':name', $_SESSION['inquiry_data']['name']);
    $pre->bindValue(':email', $_SESSION['inquiry_data']['email']);
    $pre->bindValue(':body', $_SESSION['inquiry_data']['body']);
    $pre->bindValue(':created_at', date('Y-m-d H:i:s'));

    // SQLを実行
    $r = $pre->execute();
//var_dump($r);
*/

    // SESSIONの情報を消しておく
    unset($_SESSION['inquiry_data']);
//var_dump($r); exit;
}

// 完了画面出力へlocation
header('Location: ./inquiry_fin_print.php');



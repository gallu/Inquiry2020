<?php  // swiftmailer.php
//  http://dev2.m-fr.net/XXXX/inquiry/swiftmailer.php

require_once(__DIR__ . '/../vendor/autoload.php' );

$from = 'furu@example.com';
$to = 'root@example.com'; // XXX 自分のアドレス
$subject = 'テスト';
$message = '確認用だよ';
//
/*
$r = mail($to, $subject, $message);
var_dump($r);
*/
// メール本体を作る
$message = (new Swift_Message($subject))
    ->setFrom($from)
    ->setTo($to)
    ->setBody($message)
    ;
//var_dump($message);

// 送信する
/*
$smtp = new Swift_SmtpTransport('localhost', 25);
//var_dump($smtp);
$r = (new Swift_Mailer($smtp))->send($message);
var_dump($r);
*/








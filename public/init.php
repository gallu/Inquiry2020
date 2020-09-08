<?php   // init.php
//
ob_start();
session_start(); // セッション開始

//
define('BASEPATH', realpath(__DIR__ . '/..'));
/*
var_dump( __DIR__ );
var_dump( __DIR__ . '/..' );
var_dump( realpath(__DIR__ . '/..') );
exit;
*/

// vendorを使うので
require_once(BASEPATH . '/vendor/autoload.php' );
// Configクラスの読み込み
require_once(BASEPATH . '/libs/Config.php');
// DbHandleクラスの読み込み
require_once(BASEPATH . '/libs/DbHandle.php');

// Twigインスタンスを生成
$path = BASEPATH . '/templates';
$twig = new \Twig\Environment(
    new \Twig\Loader\FilesystemLoader($path)
);
//var_dump($twig);

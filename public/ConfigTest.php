<?php  // ConfigTest.php
//
require_once('./init.php');

// テスト
echo Config::get('db_user') , "\n";
var_dump(Config::get('hoge'));
var_dump(Config::get('hoge', 'aaa'));

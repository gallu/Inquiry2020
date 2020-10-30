<?php  // ModelTest.php
// http://dev2.m-fr.net/アカウント名/inquiry/ModelTest.php

// 初期処理の読み込み
require_once('init.php');
require_once(BASEPATH . '/libs/TestModel.php');

// INSERT
$model = new TestModel();
$model->i = 10;
$model->s = 'string';
var_dump($model);

$r = $model->insert();
var_dump($r);

// SELECT
$mobj = TestModel::find(1);
var_dump($mobj);

//$mobj = TestModel::find(999);
//var_dump($mobj);

// UPDATE
//$mobj->test_id = 99; // XXX 抑止した
$mobj->i = $mobj->i + 10;
$mobj->update();
var_dump($mobj);


















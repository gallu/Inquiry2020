<?php  // property.php
// http://dev2.m-fr.net/アカウント名/inquiry/property.php
error_reporting(-1);

class Hoge {
    //
    public function __set($name, $value) {
        //
        $this->data[$name] = $value;
    }

public $pub_i;
private $pri_i;
private $data = [];
}
//
$obj = new Hoge();
$obj->pub_i = 10;
$obj->pri_i = 99; // Cannot access private property 
$obj->i = 777;
//
//$obj->'--; = 10;
$s = '\'--;';
$obj->$s = 10;

var_dump($obj);









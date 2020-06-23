<?php  // class2.php

class Datum {
    //
    public function setS($s) {
        $this->s = $s;
    }
    public function echoS() {
        echo $this->s , "\n";
    }

//public $s;
private $s;
}
//
$obj = new Datum();
//$obj->s = 'string';
$obj->setS('string');
$obj->echoS();
//
var_dump($obj);

//
$obj2 = new Datum();
$obj2->setS('hoge');
var_dump($obj2);

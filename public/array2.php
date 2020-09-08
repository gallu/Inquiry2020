<?php  // array2.php

//$awk = [1, 2, 3];
$awk = [1 => 1, 2, 3];
$awk2 = [11, 22, 33, 44];
var_dump($awk);

$awk3 = array_merge($awk, $awk2);
$awk4 = $awk + $awk2;

var_dump($awk3);
var_dump($awk4);

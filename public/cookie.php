<?php  // cookie.php
ob_start();

var_dump($_COOKIE);
// $_COOKIE['test'] = mt_rand(0, 999); // これだと入らない
setcookie('test', mt_rand(0, 999));

ob_end_flush();

<?php  // session.php
ob_start();
session_start();
var_dump($_SESSION);

$_SESSION['test'] = mt_rand(0, 999);


ob_end_flush(); 
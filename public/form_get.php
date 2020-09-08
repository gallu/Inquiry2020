<?php  // form_get.php
//
function h($s) {
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

//var_dump($_GET);
$value = @strval($_GET['value'] ?? '');
$c = $_GET['c'] ?? [];
if (false === is_array($c)) {
    $c = [$c];
}
//
//var_dump($value, $c);

//echo '入力したのは ' , $value , 'です。'; // XSS 発生中！！！！
echo '入力したのは ' , h($value) , 'です。';


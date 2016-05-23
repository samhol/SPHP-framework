<?php

namespace Sphp\Util;
$string = 'лдэфвәәуүйәуйүәу034928348539857әшаыдларорашһһрлоавы';
echo 'strlen: ' . strlen($string);
$str1 = new StringObject($string);
echo "\n\$str1 length: " . $str1->length();

?>
<?php

namespace Sphp\Stdlib;

use Sphp\Core\Config\PHPConfig;

(new PHPConfig())->setEncoding("UTF-8");

$string = 'лдэфвәәуүйәуйүәу034928348539857әшаыдларорашһһрлоавы';
echo 'strlen: ' . strlen($string);
echo "\n\StringObject length: " . (new StringObject($string))->length();
echo "\n\Strings length: " . Strings::length($string);
?>

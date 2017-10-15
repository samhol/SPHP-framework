<?php

namespace Sphp\Stdlib;

use Sphp\Config\PHPConfig;

(new PHPConfig())->setCharacterEncoding("UTF-8");

$string = 'лдэфвәәуүйәуйүәу034928348539857әшаыдларорашһһрлоавы';
echo 'strlen: ' . strlen($string);
echo "\n\StringObject length: " . (new MbString($string))->length();
echo "\n\Strings length: " . Strings::length($string);

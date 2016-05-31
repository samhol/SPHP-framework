<?php

namespace Sphp\Core\Types;

use Sphp\Core\Configuration as Configuration;

Configuration::current()->phpConfiguration()->setEncoding("UTF-8");

$string = 'лдэфвәәуүйәуйүәу034928348539857әшаыдларорашһһрлоавы';
echo 'strlen: ' . strlen($string);
echo "\n\StringObject length: " . (new StringObject($string))->length();
echo "\n\Strings length: " . Strings::length($string);
?>
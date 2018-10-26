<?php

namespace Sphp\DateTime;

$now = new DateTime();
$yesterday = $now->previousDay();
$tomorrow = $now->nextDay();
var_dump($now->compareTo($yesterday), $now->compareTo($tomorrow));
var_dump($now->compareTo('2000-01-01 13:00 EET'));

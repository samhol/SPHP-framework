<?php

namespace Sphp\DateTime;

$date1 = Date::createFromString('2001-3-4');
$date2 = Date::create(4, 3, 2001);
$hd = new Holiday(Date::createFromString('2001-12-25'), 'tbderthb');
var_dump($date2->equals($date1), $date1->equals($date2));

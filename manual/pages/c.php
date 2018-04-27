<?php

namespace Sphp\DateTime;
echo "<pre>";

$watch = new \Sphp\Stdlib\StopWatch();
$foo = new \Sphp\DateTime\Calendars\Events\VaryingAnnualHoliday("November %d second sunday", "Father's Day");
//var_dump($foo->dateMatchesWith(Date::from('2017-11-12')));
$watch->start();
$date = new Date();
for ($i = 0; $i < 100000; $i++) {
  $date = $date->nextDate();
  $foo->dateMatchesWith($date);
}

//print_r($foo);
echo "\nI: ".$watch->getTime()."\n";

echo "</pre>";

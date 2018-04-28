<?php

namespace Sphp\DateTime;

echo "<pre>";

$watch = new \Sphp\Stdlib\StopWatch();
$foo = new \Sphp\DateTime\Calendars\Events\VaryingAnnualHoliday("November %d second sunday", "Father's Day");
//var_dump($foo->dateMatchesWith(Date::from('2017-11-12')));
$watch->start();
$date = new Date();

use Sphp\DateTime\Calendars\Events\Fi\Holidays;
$f = function($evt) {
  echo "$evt\n";
};
$fiHolidays = new Holidays();
$dailyNotes = new Calendars\Events\DateEvents(new Date());
$fiHolidays->addListener($dailyNotes);
$fiHolidays->addListener($f);
$fiHolidays->createYear(2000);


//print_r($foo);
echo "\nI: " . $watch->getTime() . "\n";

echo "</pre>";

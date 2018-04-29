<?php

namespace Sphp\DateTime;

echo "<pre>";
$d1 = Date::from('2000-1-1 23:59 GMT');
$d2 = Date::from('2000-1-2 00:01 EET');
var_dump($d1->diff($d2));
var_dump($d2->diff($d1));
try {
  //$k = Date::from('foo');
} catch (\Exception $ex) {
 // echo $ex->getMessage();
}try {
  $k = $d2->modify('foo');
} catch (\Exception $ex) {
  echo $ex->getMessage();
}
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
$fiHolidays;


//print_r($foo);
echo "\nI: " . $watch->getTime() . "\n";

echo "</pre>";

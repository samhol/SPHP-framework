<?php

namespace Sphp\DateTime\Calendars;

$cd = new CalendarDate('september 16');
echo "<pre>";
$cd->addBirthday('Sami Holck');
$cd->addHoliday('Ball licking day');
//echo $cd;
$calendar = Fi\FinnishCalendar::create(2018);
$calendar->add($cd);

$cd1 = new CalendarDate(\Sphp\DateTime\Date::fromString('2018-2-11'));

$cd1->addBirthday('Pussy pounder');
$cd1->addBirthday('Homo Fucker');
$cd1->addHoliday('Ass licking day');
$calendar->add($cd1);
//echo $cd1;
//echo $calendar['2018-04-22'];
//echo $calendar[new \Sphp\DateTime\Date()];
foreach ($calendar as $day => $date) {
  echo "$day => $date\n";
}
foreach (Fi\FinnishCalendar::getSundays(2018) as $day => $date) {
  echo "$day => $date\n";
}
echo "</pre>";

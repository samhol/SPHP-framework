<?php

namespace Sphp\DateTime\Calendars;

$cd = new CalendarDate('september 16');
echo "<pre>";
$cd->getNotes()->setBirthday('Sami Holck');
$cd->getNotes()->setHoliday('Ball licking day');
//echo $cd;
$calendar = Fi\FinnishCalendar::create(2018);
$calendar->setDate($cd);

$cd1 = new CalendarDate(\Sphp\DateTime\Date::fromString('2018-2-11'));

$cd1->getNotes()->setBirthday('Pussy pounder');
$cd1->getNotes()->setBirthday('Homo Fucker');
$cd1->getNotes()->setHoliday('Ass licking day');
$calendar->setDate($cd1);
//echo $cd1;
//echo $calendar['2018-04-22'];
//echo $calendar[new \Sphp\DateTime\Date()];
foreach ($calendar as $day => $date) {
  echo "$day => $date\n";
}
foreach (Fi\FinnishCalendar::getSundays(2018) as $day => $date) {
  echo "$day => $date\n";
}

$it = new Calendar();
$it->mergeCalendar($calendar);
$it->mergeDate(new CalendarDate('1900-1-1'));
foreach ($it as $day => $date) {
  echo "$day => $date\n";
}
echo "</pre>";


<?php

$cd = new Sphp\DateTime\CalendarDate;
echo "<pre>";
$cd->addBirthday('Cock Sucker');
$cd->addBirthday('Ass Fucker');
$cd->addHoliday('Ball licking day');
//echo $cd;
$calendar = \Sphp\DateTime\FinnishCalendar::create(2018);
$calendar->add($cd);

$cd1 = new Sphp\DateTime\CalendarDate(\Sphp\DateTime\Date::fromString('2018-2-11'));

$cd1->addBirthday('Pussy pounder');
$cd1->addBirthday('Homo Fucker');
$cd1->addHoliday('Ass licking day');
$calendar->add($cd1);
//echo $cd1;
//echo $calendar['2018-04-22'];
//echo $calendar[new \Sphp\DateTime\Date()];
foreach ($calendar as $day => $date) {
  echo "$date\n";
}
echo "</pre>";

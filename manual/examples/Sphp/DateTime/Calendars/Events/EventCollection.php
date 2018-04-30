<?php

namespace Sphp\DateTime\Calendars\Events;

$rent = new Note(new Constraints\Monthly(6), 'Pay the rent');

var_dump($rent->dateMatchesWith('2018-01-06'));
echo $rent;
$annualHoliday = Holidays::annual(12, 6, 'Finland`s independence day')->setNationalHoliday()->setFlagDay();
var_dump($annualHoliday->dateMatchesWith('2018-09-16'));
$birthDay  = Holidays::birthday(9, 16, 'Sami Holck', 1975);
echo "\n$annualHoliday";
$collection = new EventCollection();
var_dump($collection->insertEvent($rent));
var_dump($collection->insertEvent($rent));
var_dump($collection->insertEvent($annualHoliday));
var_dump($collection->insertEvent($birthDay));
foreach ($collection->getNotesForDate('2018-12-06') as $note) {
  echo "$note\n";
}
/*
$cd = new AnnualHoliday(12, 25, 'Christmas Day');
var_dump($collection->insertEvent(new AnnualHoliday(12, 25, 'Christmas Day')));
var_dump($collection->insertEvent(new AnnualHoliday(12, 25, 'Christmas Day')));
var_dump($collection->insertEvent(new AnnualHoliday(12, 25, 'Christmas Day')));
echo $collection->insertBirthday(9, 16, 'Sami Holck', 1975)->eventAsString(2018);
foreach ($collection->getNotesForDate('2018-12-25') as $note) {
  echo "$note\n";
}
foreach ($collection as $note) {
  echo "$note\n";
}
$easters = new EasterHolidays();
print_r($easters->getNotesForDate('2018-4-1'));
$easters->create(2019);
$easters->mergeEvents($collection);
foreach ($easters as $note) {
  echo "$note\n";
}*/

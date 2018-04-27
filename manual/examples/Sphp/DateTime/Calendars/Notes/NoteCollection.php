<?php

namespace Sphp\DateTime\Calendars\Events;

$collection = new EventCollection();
$cd = new AnnualHoliday(12, 25, 'Christmas Day');
var_dump($collection->insertNote(new AnnualHoliday(12, 25, 'Christmas Day')));
var_dump($collection->insertNote(new AnnualHoliday(12, 25, 'Christmas Day')));
var_dump($collection->insertNote(new AnnualHoliday(12, 25, 'Christmas Day')));
echo $collection->insertBirthday(16, 9, 'Sami Holck', 1975)->noteAsString(2018);
foreach ($collection->getNotesForDate('2018-12-25') as $note) {
  echo "$note\n";
}
foreach ($collection as $note) {
  echo "$note\n";
}
$easters = new EasterHolidays();
print_r($easters->getNotesForDate('2018-4-1'));
$easters->buildYear(2019)->buildYear(2017);
$easters->mergeNotes($collection);
foreach ($easters as $note) {
  echo "$note\n";
}

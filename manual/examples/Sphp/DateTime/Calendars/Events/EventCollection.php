<?php

namespace Sphp\DateTime\Calendars\Events;

$collection = new EventCollection();
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
}

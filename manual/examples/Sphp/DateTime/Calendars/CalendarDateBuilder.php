<?php

namespace Sphp\DateTime\Calendars\Events;

//$notes = new Notes\EasterHolidays;
//$gen = new CalendarDateBuilder($notes);
//echo $gen->createCalendarDate('2018-03-29');

$dailyNotes = new DateEvents(\Sphp\DateTime\Date::from('2018-09-16'));


var_dump($dailyNotes->insertEvent(new BirthDay(9, 16, 'Sami Holck', 1975)));
var_dump($dailyNotes->insertEvent(Holidays::annual(9, 16, 'Sami Holck is GOD day')));


echo $dailyNotes;

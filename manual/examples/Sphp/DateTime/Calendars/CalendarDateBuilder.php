<?php

namespace Sphp\DateTime\Calendars;

$notes = new Notes\EasterHolidays;
$gen = new CalendarDateBuilder($notes);

echo $gen->createCalendarDate('2018-03-27');

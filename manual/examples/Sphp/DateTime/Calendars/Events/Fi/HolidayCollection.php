<?php


namespace Sphp\DateTime\Calendars\Events;

$fiHolidays = new Fi\HolidayCollection();

foreach($fiHolidays->getEventsForDate('2018-10-10') as $holiday) {
  echo "$holiday\n";
}

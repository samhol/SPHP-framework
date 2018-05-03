<?php

namespace Sphp\Html\Apps\Calendars;

use Sphp\DateTime\Calendars\Events\EasterHolidays;
use Sphp\DateTime\Calendars\Events\Fi\HolidayCollection;
use Sphp\DateTime\Calendars\Calendar;
use Sphp\DateTime\Calendars\Events\Events;
use Sphp\DateTime\Calendars\Events\Holidays;

$trimmed = trim($par, '/');
$parts = explode('/', $trimmed);
$year = (int) date('Y');
$month = (int) date('m');
if (count($parts) > 1) {
  if (is_numeric($parts[1])) {
    $year = (int) $parts[1];
  } else {
    
  }
}if (count($parts) > 2) {
  if (is_numeric($parts[2])) {
    $month = (int) $parts[2];
  } else {
    
  }
}
print_r($parts);
$easter = new EasterHolidays($year);
$fi = new HolidayCollection();
$data = new Calendar();
$data->useEvents($fi);
$fi->insertEvent(Holidays::birthday(9, 16, 'Sami Holck', 1975));
$fi->insertEvent(Holidays::birthday(12, 23, 'Ella Lisko', 1977));
$fi->setEasterFor(2017)->setEasterFor(2018);
$fi->insertEvent(Events::weekly([1, 2, 3, 7], 'Basketball'));
$fi->insertEvent(Events::weekly([1, 2, 3, 7], 'Basketball1'));

//$data->setBirthDay('', $name);
//$fi->createYear();
$fi;
echo Factory::getMonth($month, $year)->useCalendar($data);

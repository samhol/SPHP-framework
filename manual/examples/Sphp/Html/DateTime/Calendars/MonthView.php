<?php

namespace Sphp\Html\DateTime\Calendars;

use Sphp\DateTime\Calendars\Events\EasterHolidays;
use Sphp\DateTime\Calendars\Events\Fi\HolidayCollection;
use Sphp\DateTime\Calendars\Calendar;
use Sphp\DateTime\Calendars\Events\Events;
use Sphp\DateTime\Calendars\Events\Holidays;

$easter = new EasterHolidays();
$fi = new HolidayCollection();
$data = new Calendar();
$data->useEvents($fi);
$fi->insertEvent(Holidays::birthday(9, 16, 'Sami Holck', 1975));
$fi->insertEvent(Holidays::birthday(12, 23, 'Ella Lisko', 1977));
$fi->setEasterFor(2017)->setEasterFor(2018);
$fi->insertEvent(Events::weekly([1, 2, 3, 7], 'Basketball'));
$fi->insertEvent(Events::weekly([1, 2, 3, 7], 'Basketball1'));

//$data->setBirthDay('', $name);
echo Factory::getMonth(12, 2017)->useCalendar($data);
echo Factory::getMonth(1)->useCalendar($data);
echo Factory::getMonth()->useCalendar($data);

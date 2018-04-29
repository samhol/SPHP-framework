<?php

namespace Sphp\Html\Apps\Calendars;

use Sphp\DateTime\Calendars\Events\EasterHolidays;
use Sphp\DateTime\Calendars\Events\Fi\Holidays;
use Sphp\DateTime\Calendars\Calendar;

$easter = new EasterHolidays();
$fi = new Holidays();
$data = new Calendar();
$data->useEvents($fi);
$fi->insertBirthday(9, 16, 'Sami Holck', 1975);
$fi->insertBirthday(12, 23, 'Ella Lisko', 1977);
$fi->setEasterFor(2017)->setEasterFor(2018);
$fi->insertEvent(\Sphp\DateTime\Calendars\Events\Events::weeklyNote([1, 2, 3, 7], 'Basketball'));

//$data->setBirthDay('', $name);
//$fi->createYear();
$fi;
echo Factory::getMonth(6, 2017)->useCalendar($data);
echo Factory::getMonth(7, 2017)->useCalendar($data);
echo Factory::getMonth(8, 2017)->useCalendar($data);
echo Factory::getMonth(9, 2017)->useCalendar($data);
echo Factory::getMonth(10, 2017)->useCalendar($data);
echo Factory::getMonth(11, 2017)->useCalendar($data);
echo Factory::getMonth(12, 2017)->useCalendar($data);
echo Factory::getMonth(1)->useCalendar($data);
echo Factory::getMonth(2)->useCalendar($data);
echo Factory::getMonth(3)->useCalendar($data);
echo Factory::getMonth(4)->useCalendar($data);
echo Factory::getMonth(5)->useCalendar($data);

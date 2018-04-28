<?php

namespace Sphp\Html\Apps\Calendars;

use Sphp\DateTime\Calendars\Events\EasterHolidays;
use Sphp\DateTime\Calendars\Events\Fi\Holidays;
use Sphp\DateTime\Calendars\Calendar;

$easter = new EasterHolidays();
$fi = new Holidays();
$data = new Calendar();
$data->useEvents($fi);
//$data->setBirthDay('', $name);
//$fi->createYear();
$fi->createYear(2018);
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

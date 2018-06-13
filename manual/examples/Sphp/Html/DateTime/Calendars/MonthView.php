<?php

namespace Sphp\Html\DateTime\Calendars;

use Sphp\DateTime\Calendars\Diaries\Logs;
use Sphp\DateTime\Calendars\Diaries\Holidays\Holidays;
use Sphp\DateTime\Calendars\Diaries\Holidays\EasterHolidays;
use Sphp\DateTime\Calendars\Diaries\Holidays\Fi\HolidayDiary;

$easter = new EasterHolidays();
$fi = new HolidayDiary();
//$data = new Calendar();
//$data->useEvents($fi);
$fi->insertLog(Holidays::birthday(9, 16, 'Sami Holck', 1975));
$fi->insertLog(Holidays::birthday(12, 23, 'Ella Lisko', 1977));
$fi->setEasterFor(2017)->setEasterFor(2018);
$fi->insertLog(Logs::weekly([1, 2, 3, 7], 'Basketball'));
$fi->insertLog(Logs::weekly([1, 2, 3, 7], 'Basketball1'));

//$data->setBirthDay('', $name);
echo Factory::getMonth(12, 2017)->insertDiary($fi);
echo Factory::getMonth(1)->insertDiary($fi);
echo Factory::getMonth()->insertDiary($fi);

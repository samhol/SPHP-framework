<?php

namespace Sphp\Html\Apps\Calendars;
$data = new \Sphp\DateTime\Calendars\Fi\Calendar();
//$data->setBirthDay('', $name);
$data->createYear(2017);
$data->createYear(2018);
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

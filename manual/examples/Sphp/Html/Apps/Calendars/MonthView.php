<?php

namespace Sphp\Html\Apps\Calendars;

$past = new MonthView(2017, 12);
$past->setHolidays(new \Sphp\DateTime\Holidays\Finland\FinnishHolidays(2017));
echo $past;

$now = new MonthView();

echo $now;

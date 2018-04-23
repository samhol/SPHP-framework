<?php

namespace Sphp\Html\Apps\Calendars;

$past = new MonthView(2017, 12);
$past->useCalendar(\Sphp\DateTime\Calendars\Fi\FinnishCalendar::create(2017));
echo $past;

$now = new MonthView();

echo $now;

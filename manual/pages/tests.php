<?php

use Sphp\Html\DateTime\Calendars\WeekView;
use Sphp\DateTime\Date;

include 'diaries.php';
echo "<pre>";
$weekView = new WeekView($diaryContainer);
echo $weekView->createWeekRow(new Date('2018-9-16'));
echo "</pre>";

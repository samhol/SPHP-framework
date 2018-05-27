<?php

echo "<pre>";

use Sphp\DateTime\Calendars\Diaries;
use Sphp\DateTime\Calendars\Diaries\Holidays\Holidays;
use Sphp\DateTime\Calendars\Diaries\Holidays\Fi\HolidayDiary;

$birthDayDiary = new Diaries\BasicDiary();

$birthDayDiary->insertLog(Holidays::birthday(7, 22, 'Leena Holck', 1947));
$birthDayDiary->insertLog(Holidays::birthday(9, 16, 'Sami Holck', 1975));

$birthDayDiary->insertLog(Holidays::birthday(12, 23, 'Ella Lisko', 1977));

foreach ($birthDayDiary as $log) {
  echo $log;
}
echo $birthDayDiary->getLogs('2018-09-16');

$diaryContainer = new Diaries\DiaryContainer();

$diaryContainer->insertDiary(new HolidayDiary());
$diaryContainer->insertDiary($birthDayDiary);
echo "\n" . $diaryContainer->getDay('1990-12-06');

echo "</pre>";

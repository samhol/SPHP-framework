<?php

echo "<pre>";

use Sphp\DateTime\Calendars\Diaries;
use Sphp\DateTime\Calendars\Diaries\Holidays\Holidays;
use Sphp\DateTime\Calendars\Diaries\Holidays\Fi\HolidayDiary;
use Sphp\DateTime\Calendars\Diaries\Logs;
use Sphp\DateTime\Calendars\Diaries\Constraints\OneOf;
use Sphp\DateTime\Calendars\Diaries\Sports\WorkoutDiary;
use Sphp\DateTime\Calendars\Diaries\Sports\FitNotes;

$birthDayDiary = new Diaries\BasicDiary();

$birthDayDiary->insertLog(Holidays::birthday(7, 22, 'Leena Holck', 1947));
$birthDayDiary->insertLog(Holidays::birthday(9, 16, 'Sami Holck', 1975));

$birthDayDiary->insertLog(Holidays::birthday(12, 23, 'Ella Lisko', 1977));
$sportsDiary = FitNotes::fromCsv('manual/snippets/FitNotes.csv');
$basketball1 = Logs::weekly([1], 'Basketball');
$basketball1->setDescription('In Vaarniemi **20:30-22:00**');
$basketball1->dateConstraints()->dateIsNot(new OneOf("2018-4-30", "2018-5-1"));
$basketballDiary = new Diaries\BasicDiary();
$basketballDiary->insertLog(Logs::weekly([5,6,4], 'Bball'));
$basketballDiary->insertLog($basketball1);
foreach ($birthDayDiary as $log) {
  echo $log;
}
echo $birthDayDiary->getLogs('2018-09-16');

$diaryContainer = new Diaries\DiaryContainer();

$diaryContainer->insertDiary($basketballDiary);

$diaryContainer->insertDiary($sportsDiary);
$diaryContainer->insertDiary(new HolidayDiary());
$diaryContainer->insertDiary($birthDayDiary);
echo "\n" . $diaryContainer->getDay('1990-12-06');
echo "\n" . $diaryContainer->getDay('2017-12-24');
echo "\n" . $diaryContainer->getDay('2018-05-03');
echo "</pre>";

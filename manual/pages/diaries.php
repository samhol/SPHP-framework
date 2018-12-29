<?php

namespace Sphp\Html\DateTime\Calendars;

use Sphp\DateTime\Calendars\Diaries\Holidays\Fi\HolidayDiary;
use Sphp\DateTime\Calendars\Diaries\Logs;
use Sphp\DateTime\Calendars\Diaries\Holidays\Holidays;

//use Sphp\Stdlib\StopWatch;
echo "<pre>";
if (!isset($year)) {
  $year = (int) date('Y');
}
if (!isset($year)) {
  $month = (int) date('m');
}
//var_dump(StopWatch::getEcecutionTime());
//$easter = new EasterHolidays($year);
$fi = new HolidayDiary();

//$data = new Calendar();

use Sphp\DateTime\Calendars\Diaries\Constraints\OneOf;

//$data->useEvents($fi);
//print_r($fi->getDate('2018-12-06'));
//print_r($fi->getDate('2018-12-06')->getHolidays());
$fi->insertLog(Holidays::birthday('1975-9-16', 'Sami, Holck'));
$fi->insertLog(Holidays::birthday('1977-12-23', 'Ella, Lisko'));
$fi->insertLog(Holidays::birthday('1918-1-7', 'Vilho, Koivisto'));
$fi->setEasterFor($year);
$basketball = Logs::weekly([7], '');
$basketball->setDescription('Basketball at Ruiskatu **19:00-21:00**');
$basketball->dateConstraints()
        ->isAfter('2017-8-31')
        ->isBefore('2018-6-1')
        ->dateIsNot(new OneOf("$year-4-30", "$year-5-1"));
$fi->insertLog($basketball);
$basketball1 = Logs::weekly([1, 3], 'Basketball at the School of Vaarniemi');
$basketball1->setDescription('time: **20:30-22:00**');
$basketball1->dateConstraints()->isAfter('2018-1-1')->isNotInRange('2018-6-1', '2018-8-25')->dateIsNot(new OneOf("$year-4-30", "$year-5-1"));

$fi->insertLog($basketball1);

$exercises = \Sphp\DateTime\Calendars\Diaries\Sports\FitNotes::fromCsv(__DIR__ . '/../snippets/FitNotes.csv');
/* foreach ($exercises as $excercise) {
  foreach ($excercise as $workout) {
  if ($workout instanceof \Sphp\DateTime\Calendars\Diaries\Sports\WeightLiftingExercise) {
  //var_dump($workout->totalsToString());
  //print_r($workout->toArray());
  }
  }
  } */

$workCalendar = new \Sphp\DateTime\Calendars\Diaries\MutableDiary();
$liucon = Logs::weekly([1, 2, 3, 4, 5], 'Working as an employee for Liucon OY');
$liucon->dateConstraints()->isAfter('2018-5-9')->isBefore('2018-8-11');
$workCalendar->insertLog($liucon);
$workCalendar->insertLog(new \Sphp\DateTime\Calendars\Diaries\Schedules\SingleTask('2018-5-20 11:00 EET', '2018-5-20 12:00 EET'));
//var_dump($exercises instanceof \Sphp\DateTime\Calendars\Diaries\DiaryInterface);
$diaryContainer = new \Sphp\DateTime\Calendars\Diaries\DiaryContainer();

$diaryContainer->insertDiary($fi);
//$diaryContainer->insertDiary($basketball);
$diaryContainer->insertDiary($exercises);
$diaryContainer->insertDiary($workCalendar);
//print_r($diaryContainer);
//var_dump($diaryContainer->getDay('2018-05-01'));
//var_dump(\Sphp\Stdlib\StopWatch::getEcecutionTime());
echo '</pre>';


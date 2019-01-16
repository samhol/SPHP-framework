<?php

namespace Sphp\Html\DateTime\Calendars;

use Sphp\DateTime\Calendars\Diaries\Holidays\Fi\HolidayDiary;
use Sphp\DateTime\Calendars\Diaries\Logs;
use Sphp\DateTime\Calendars\Diaries\Holidays\Holidays;
use Sphp\DateTime\Calendars\Diaries\Schedules\RepeatingTask;
use Sphp\DateTime\Calendars\Diaries\MutableDiary;
use Sphp\DateTime\Calendars\Diaries\Sports\FitNotes;

//echo "<pre>";
if (!isset($year)) {
  $year = (int) date('Y');
}
if (!isset($year)) {
  $month = (int) date('m');
}
//var_dump(StopWatch::getEcecutionTime());
//$easter = new EasterHolidays($year);
$fi = new HolidayDiary();

$fi->insertLog(Logs::annual(2,29, 'Sami, Holck'));
$fi->insertLog(Holidays::birthday('1975-9-16', 'Sami, Holck'));
$fi->insertLog(Holidays::birthday('1977-12-23', 'Ella, Lisko'));
$fi->insertLog(Holidays::birthday('1918-1-7', 'Vilho, Koivisto'));
$fi->setEasterFor($year);
$misc = new MutableDiary();
$basketball = RepeatingTask::from('19:00', '21:00');
$basketball->setDescription('Basketball at Ruiskatu');
$basketball->dateRule()
        ->isWeekly(7)
        ->isAfter('2017-8-31')
        ->isBefore('2018-6-1')
        ->isNotOneOf("$year-4-30", "$year-5-1");
$misc->insertLog($basketball);
$basketball1 = RepeatingTask::from('20:30', '22:00');
$basketball1->setDescription('Basketball at the School of Vaarniemi');
$basketball1->dateRule()
        ->isWeekly(1, 3)
        ->isAfter('2018-1-1')
        ->isBefore('2019-6-1')
        ->isNotBetween('2018-6-1', '2018-8-25')
        ->isNotOneOf("$year-4-30", "$year-5-1");
$misc->insertLog($basketball1);

$vaasa = new \Sphp\DateTime\Calendars\Diaries\Schedules\SingleTask('2018-7-19', '2018-7-21');
$vaasa->setDescription('Trip to Vaasa');

$misc->insertLog($vaasa);

$exercises = FitNotes::fromCsv(__DIR__ . '/../snippets/FitNotes.csv');
/* foreach ($exercises as $excercise) {
  foreach ($excercise as $workout) {
  if ($workout instanceof \Sphp\DateTime\Calendars\Diaries\Sports\WeightLiftingExercise) {
  //var_dump($workout->totalsToString());
  //print_r($workout->toArray());
  }
  }
  } */

$workCalendar = new \Sphp\DateTime\Calendars\Diaries\MutableDiary();
$liucon = RepeatingTask::from('7:00', '15:30');
$liucon->setDescription('Working as an employee for Liucon OY');
$liucon->dateRule()
        ->isWeekly(1, 2, 3, 4, 5)
        ->isAfter('2018-5-9')
        ->isBefore('2018-8-11')
        ->isNotOneOf('2018-7-19', '2018-7-20');
$workCalendar->insertLog($liucon);
$liucon1 = \Sphp\DateTime\Calendars\Diaries\Schedules\PeriodicTask::from('R50/2018-05-09T07:00:00Z/P1D', 'PT7H30M');
$liucon1->setDescription('Working as an employee for Liucon OY');
$liucon1->dateConditions()
        ->isWeekly(1, 2, 3, 4, 5)
        ->isAfter('2018-5-9')
        ->isBefore('2018-8-11')
        ->isNotOneOf('2018-7-19', '2018-7-20');
$workCalendar->insertLog($liucon1);
$workCalendar->insertLog(new \Sphp\DateTime\Calendars\Diaries\Schedules\SingleTask('2018-5-20 11:00 EET', '2018-5-20 12:00 EET'));
//var_dump($exercises instanceof \Sphp\DateTime\Calendars\Diaries\DiaryInterface);
$diaryContainer = new \Sphp\DateTime\Calendars\Diaries\DiaryContainer();

$diaryContainer->insertDiary($fi);
$diaryContainer->insertDiary($misc);
//$diaryContainer->insertDiary($basketball);
$diaryContainer->insertDiary($exercises);
$diaryContainer->insertDiary($workCalendar);

//echo '</pre>';


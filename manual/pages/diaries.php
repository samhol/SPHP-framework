<?php

namespace Sphp\Html\DateTime\Calendars;

use Sphp\DateTime\Calendars\Diaries\Holidays\Fi\HolidayDiary;
use Sphp\DateTime\Calendars\Diaries\Logs;
use Sphp\DateTime\Calendars\Diaries\Holidays\Holidays;

//use Sphp\Stdlib\StopWatch;
echo "<pre>";

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
$basketball = Logs::weekly([7], 'Basketball');
$basketball->setDescription('In Ruiskatu **19:00-21:00**');
$basketball->dateConstraints()->dateIsNot(new OneOf("$year-4-30", "$year-5-1"));
$fi->insertLog($basketball);
$basketball1 = Logs::weekly([1], 'Basketball');
$basketball1->setDescription('In Vaarniemi **20:30-22:00**');
$basketball1->dateConstraints()->dateIsNot(new OneOf("$year-4-30", "$year-5-1"));

//$fi->insertLog($basketball1);

$exercises = \Sphp\DateTime\Calendars\Diaries\Sports\FitNotes::fromCsv('../../manual/snippets/FitNotes.csv');
foreach ($exercises as $excercise) {
  foreach ($excercise as $workout) {
    if ($workout instanceof \Sphp\DateTime\Calendars\Diaries\Sports\WeightLiftingExercise) {
      //var_dump($workout->totalsToString());
      //print_r($workout->toArray());
    }
  }
}
//var_dump($exercises instanceof \Sphp\DateTime\Calendars\Diaries\DiaryInterface);
$diaryContainer = new \Sphp\DateTime\Calendars\Diaries\DiaryContainer();

$diaryContainer->insertDiary($fi);
//$diaryContainer->insertDiary($basketball);
$diaryContainer->insertDiary($exercises);
//print_r($diaryContainer);
//var_dump($diaryContainer->getDay('2018-05-01'));
//var_dump(\Sphp\Stdlib\StopWatch::getEcecutionTime());
echo '</pre>';


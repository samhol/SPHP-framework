<?php

namespace Sphp\Html\DateTime\Calendars;

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('../settings.php');

$year = 2018;
include '../../samiholck/calendar/diaries.php';

$section = new DateInfoContentGenerator();
$date = filter_input(INPUT_GET, 'date', FILTER_SANITIZE_STRING);
if ($date === null) {
  $date = new \Sphp\DateTime\Date;
}
//echo $date;
echo $section->generate($diaryContainer->getDate($date));

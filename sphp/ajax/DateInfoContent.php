<?php

namespace Sphp\Html\DateTime\Calendars;

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('../../manual/settings.php');

$year = 2018;
include '../../manual/pages/diaries.php';

$cont = new DateInfoContetnGenerator();
$date = filter_input(INPUT_GET, 'date', FILTER_SANITIZE_STRING);
if ($date === null) {
  $date = new \Sphp\DateTime\Date;
}
//echo $date;
echo $cont->generate($diaryContainer->getDate($date));

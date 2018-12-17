<?php

namespace Sphp\Html\DateTime\Calendars;


$trimmed = trim($par, '/');
$parts = explode('/', $trimmed);
$year = (int) date('Y');
$month = (int) date('m');
if (count($parts) > 1) {
  if (is_numeric($parts[1])) {
    $year = (int) $parts[1];
  } else {
    
  }
}
if (count($parts) > 2) {
  if (is_numeric($parts[2])) {
    $month = (int) $parts[2];
  } else {
    
  }
}

$d = \Sphp\DateTime\Date::from("$year-$month-01")->format("F Y");
echo \Sphp\Manual\md("# Calendar for <small>$d</small>");

//var_dump(StopWatch::getEcecutionTime());
class CalendarController {

  private $model;

  public function __construct($model) {
    $this->model = $model;
  }

  public function clicked() {
    $this->model->string = 'Updated Data, thanks to MVC and PHP!';
  }

}

include 'diaries.php';

use Sphp\Html\Foundation\Sites\Navigation\Pagination\Paginator;

$pagination = new Paginator();

//var_dump($pages);
$intl = new \DateTimeImmutable("$year-$month-01");
$begin = $intl->modify('- 1 year');
$end = $intl->modify('+ 1 year');

$interval = new \DateInterval('P1M');
$daterange = new \DatePeriod($begin, $interval, $end);

use Sphp\Html\Foundation\Sites\Navigation\Pagination\Page;

//$exercises = FitNotes::fromCsv('manual/snippets/FitNotes.csv');
foreach ($daterange as $id => $date) {
  $href = "calendar/" . $date->format("Y/m");
  $content = $date->format("M Y");
  $page = new Page($href, $content);
  if ($date->format("Y") == $year && $date->format("m") == $month) {
    $page->setCurrent(true);
  }
  $pagination->append($page);
}


echo Factory::getMonth($month, $year)->setDiaryContainer($diaryContainer);

$pagination
        ->visibleAfterCurrent(3)
        ->visibleBeforeCurrent(3)
        ->printHtml();

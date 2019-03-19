<?php

declare(strict_types=1);
namespace Sphp\Html\DateTime\Calendars;

use Sphp\Network\URL;

$current = URL::getCurrent();
$path = $current->getPath();
$trimmed = trim($path, '/');
$parts = explode('/', $trimmed);
//print_r($parts);
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
$calendarDate = \Sphp\DateTime\Date::from("$year-$month-01")->format("F Y");
\Sphp\Manual\md("# Calendar for <small>$calendarDate</small>");


include 'diaries.php';


echo Factory::getMonth($month, $year)->setDiaryContainer($diaryContainer);

use Sphp\Html\Foundation\Sites\Navigation\Pagination\Pagination;

$pagination = new Pagination();

//var_dump($pages);
$intl = new \DateTimeImmutable("$year-$month-01");
$begin = $intl->modify('- 3 month');
$end = $intl->modify('+ 3 month');

$interval = new \DateInterval('P1M');
$daterange = new \DatePeriod($begin, $interval, $end);

use Sphp\Html\Foundation\Sites\Navigation\Pagination\Page;
use Sphp\Html\Tags;



//$exercises = FitNotes::fromCsv('manual/snippets/FitNotes.csv');
function createUrl($date): string {
  return "/calendar/" . $date->format("Y/m");
}

foreach ($daterange as $id => $date) {
  $href = "/calendar/" . $date->format("Y/m");
  $text = Tags::strong($date->format('m')) . $date->format('/Y');
  $page = new Page(createUrl($date), $text);
  if ($date->format("Y") == $year && $date->format("m") == $month) {
    $prev = $date->modify('-1 month');
    $pagination->setPrevious(createUrl($prev), 'Previous');
    $page->setCurrent(true);
    $current = $page;
    $pagination->setNext(createUrl($date->modify('+1 month')), 'Next');
  }
  $prev = $page;
  $pagination->insertPage($page);
}

$pagination->addCssClass('text-center')->printHtml();

echo '<pre>';
    print_r(\Sphp\Config\ErrorHandling\ErrorToExceptionThrower::$defaultInstance);

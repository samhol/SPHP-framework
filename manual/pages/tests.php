<?php

namespace Sphp\Data\Sports;
//use Sphp\Html\DateTime\Calendars;
//$rawData = Parser::csv()->arrayFromFile('manual/snippets/FitNotes.csv');
$exercises = FitNotes::fromCsv('manual/snippets/FitNotes.csv');
?>
<pre>
<?php

namespace Sphp\Html\DateTime\Calendars;

use Sphp\DateTime\Calendars\Diaries\Holidays\EasterHolidays;
use Sphp\DateTime\Calendars\Diaries\Holidays\Fi\HolidayDiary;
use Sphp\DateTime\Calendars\Calendar;
use Sphp\DateTime\Calendars\Diaries\Logs;
use Sphp\DateTime\Calendars\Diaries\Holidays\Holidays;

$trimmed = trim($par, '/');
$parts = explode('/', $trimmed);
$year = (int) date('Y');
$month = (int) date('m');
if (count($parts) > 1) {
  if (is_numeric($parts[1])) {
    $year = (int) $parts[1];
  } else {
    
  }
}if (count($parts) > 2) {
  if (is_numeric($parts[2])) {
    $month = (int) $parts[2];
  } else {
    
  }
}
print_r($parts);
$easter = new EasterHolidays($year);
$fi = new HolidayDiary();
$data = new Calendar();

use Sphp\DateTime\Calendars\Diaries\Constraints\OneOf;

$data->useEvents($fi);
$fi->insertLog(Holidays::birthday(9, 16, 'Sami Holck', 1975));
$fi->insertLog(Holidays::birthday(12, 23, 'Ella Lisko', 1977));
$fi->setEasterFor($year);
$basketball = Logs::weekly([7], 'Basketball');
$basketball->setDescription('In Ruiskatu **19:00-21:00**');
$basketball->dateConstraints()->dateIsNot(new OneOf("$year-4-30", "$year-5-1"));
$fi->insertLog($basketball);
$basketball1 = Logs::weekly([1], 'Basketball');
$basketball1->setDescription('In Vaarniemi **20:30-22:00**');
$basketball1->dateConstraints()->dateIsNot(new OneOf("$year-4-30", "$year-5-1"));
$fi->insertLog($basketball1);

//$fi->insertEvent(Events::weekly([1, 2, 3, 7], 'Basketball1'));


use Sphp\Html\Foundation\Sites\Navigation\Pagination\Paginator;

$pagination = new Paginator();

//var_dump($pages);
$intl = new \DateTimeImmutable("$year-$month-01");
$begin = $intl->modify('- 1 year');
$end = $intl->modify('+ 1 year');

$interval = new \DateInterval('P1M');
$daterange = new \DatePeriod($begin, $interval, $end);

use Sphp\Html\Foundation\Sites\Navigation\Pagination\Page;
use Sphp\Data\Sports\FitNotes;
$exercises = FitNotes::fromCsv('manual/snippets/FitNotes.csv');
foreach ($daterange as $id => $date) {
  $href = "calendar/" . $date->format("Y/m");
  $content = $date->format("M Y");
  $page = new Page($href, $content);
  if ($date->format("Y") == $year && $date->format("m") == $month) {
    $page->setCurrent(true);
  }
  $pagination->append($page);
}

$pagination
        ->visibleAfterCurrent(3)
        ->visibleBeforeCurrent(3)
        ->printHtml();
?>

<?php

echo Factory::getMonth($month, $year)->useCalendar($data);
echo '<pre>';
//print_r((new \Sphp\DateTime\Calendars\Events\Constraints\Before('2018-11-1'))->toJson());
//print_r(Parser::fromFile('manual/templates/calendar.yml'));
//print_r(Parser::csv()->arrayFromFile('manual/snippets/FitNotes.csv'));
echo '</pre>';

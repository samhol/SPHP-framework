<pre>
<?php

$begin = new DateTime('2012-08-01');
$end = new DateTime('2012-08-31');
$end = $end->modify('+1 day');

$interval = new DateInterval('P7D');
$daterange = new DatePeriod($begin, $interval, $end);

foreach ($daterange as $date) {
  echo $date->format("Y-m-d l") . "<br>";
}

$foo = new \Sphp\DateTime\Calendars\Diaries\Schedules\RepeatingTask1(new Sphp\DateTime\Period('R2/2012-01-01T19:00:00Z/P7D'), 'PT1H30M');
$foo->setDescription('Total foo');
foreach ($foo as $task) {
  echo "$task\n";
}
?>
</pre>
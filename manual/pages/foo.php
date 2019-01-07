<pre>
<?php


$foo =  \Sphp\DateTime\Calendars\Diaries\Schedules\RepeatingTask1::from('R2/2012-01-01T19:00:00Z/P7D', 'PT1H30M');
$foo->setDescription('Total foo');
foreach ($foo as $task) {
  echo "$task\n";
}
?>
</pre>
<?php

use Sphp\Html\Forms\Inputs\Menus\MenuFactory;

$row = new \Sphp\Html\Foundation\Sites\Grids\Row();
$year = (int) date('Y');
$startYear = $year - 5;
$stopYear = $year + 1;

$row->appendColumn(MenuFactory::getContentAsValueMenu(range($startYear, $stopYear))->setSelectedValues($year));
$row->appendColumn(MenuFactory::months('month')->setSelectedValues(date('m')));

echo $row;
?>
<pre><?php
  $foo = \Sphp\DateTime\Calendars\Diaries\Schedules\PeriodicTask::from('R2/2012-01-01T19:00:00Z/P7D', 'PT1H30M');
  $foo->setDescription('Total foo');
  foreach ($foo as $task) {
    echo "$task\n";
  }
  ?>
</pre>
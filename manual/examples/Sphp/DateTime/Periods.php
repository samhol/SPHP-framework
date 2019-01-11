<?php

namespace Sphp\DateTime;

$p = Periods::weeksOfMonth();
$start = $p->getStartDate();
  echo $start->format('Y');
foreach ($p as $date) {
  echo "\n week: {$date->format('W')}";
  foreach (Periods::days($date, 6) as $wd) {
    echo "\n   {$wd->format('l F jS')} ";
  }
}

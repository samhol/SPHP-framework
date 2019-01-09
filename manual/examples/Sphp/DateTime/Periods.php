<?php

namespace Sphp\DateTime;

$p = Periods::weeksOfMonth();
foreach ($p as $date) {
  echo "\n week: {$date->format('W')}";
    echo "\nfirst: ". $date->format('Y-m-d D');
  foreach (Periods::days($date, 6) as $wd) {
    echo "\n\t{$wd->format('Y-m-d D')} ";
  }
}

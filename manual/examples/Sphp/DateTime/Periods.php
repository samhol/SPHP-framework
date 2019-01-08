<?php

namespace Sphp\DateTime;

$p = Periods::weeksOfMonth();
foreach ($p as $date) {
  echo "\n week: {$date->format('W')}";
  foreach (Periods::d($date, 6) as $wd) {
    echo "\n\t{$wd->format('Y-m-d D')} ";
  }
}

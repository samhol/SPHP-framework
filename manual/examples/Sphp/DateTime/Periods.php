<?php

namespace Sphp\DateTime;

$year = date('Y');
$month = date('m');

$d = DateTime::from("$year-$month-1 12:01");
$start = $d->modify('last monday');
$stop = $d->modify('last day of')->modify('next sunday');

$p = new Period($start->getDateTime(), new Interval('P1W'), $stop->getDateTime());
foreach ($p as $date) {
  echo "\n week: {$date->format('W')}";
  foreach (Periods::d($date, 6) as $wd) {
    echo "\n\t{$wd->format('Y-m-d D')} ";
  }
}

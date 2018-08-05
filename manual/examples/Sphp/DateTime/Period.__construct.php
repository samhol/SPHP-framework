<?php

namespace Sphp\DateTime;

foreach (Period::months('2010-1-5 10:00 EET', '2010-7-1 10:00 EET') as $date) {
  echo "{$date->format('M')} ";
}

echo "\n";
foreach (Period::w('2010-1-1 10:00 EET', 10, 2) as $date) {
  echo "week: {$date->format('W')}. ";
}

echo "\n";
foreach (Period::days('2010-1-1 10:00 EET', 6) as $date) {
  echo "{$date->format('D')} ";
}

echo "\n";
foreach (Period::hours('2010-1-1 10:00 EET', 10, 4) as $date) {
  echo "{$date->format('H:i')} ";
}
echo "\n";
foreach (Period::hours('2010-1-1 10:00 EET', 10, -1) as $date) {
  echo "{$date->format('H:i')} ";
}
$year = date('Y');
$month = date('m');
$d = DateTime::from("$year-$month-1 12:01");
$start = $d->modify('last monday');

$stop = $d->modify('last day of')->modify('next sunday');

echo "\n";
echo "{$d->format('Y-m-d l H:i:s')}\n";
echo "{$start->format('Y-m-d l H:i:s')}\n";
echo "{$stop->format('Y-m-d l H:i:s')}\n";
$p = new Period($start->getDateTime(), new Interval('P1W'), $stop->getDateTime());
foreach ($p as $date) {
  echo "\n week: {$date->format('W')}";
  foreach (Period::d($date, 6) as $wd) {
    echo "\n\t{$wd->format('Y-m-d D')} ";
  }
}
foreach (Period::d($start, $stop, 7) as $date) {
  //echo "\n\t\t{$date->format('Y-m-d D H:i:s')} ";
}

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

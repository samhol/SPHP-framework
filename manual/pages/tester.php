<?php

use Sphp\DateTime\Calendars\Diaries;

$diary = new Diaries\EventCollection();

$diary->insertLog(Diaries\Holidays\Holidays::birthday(9, 16, 'Sami Holck', 1975));

foreach ($diary as $log) {
  echo $log;
}
echo $diary->getLogs('2018-09-16');

<?php

use Sphp\DateTime\Holidays\Finland\FinnishHolidays;

$sp = new FinnishHolidays(2018);

foreach ($sp as $d) {
  echo "\n$d";
}

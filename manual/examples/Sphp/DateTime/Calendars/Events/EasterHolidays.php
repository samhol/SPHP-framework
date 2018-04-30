<?php

namespace Sphp\DateTime\Calendars\Events;

$easter2018 = new EasterHolidays(2018);

foreach ($easter2018 as $event) {
  echo "$event\n";
}

<?php

namespace Sphp\DateTime\Calendars\Events;

$easterCalendar = new EasterCalendar();

foreach (EasterCalendar::build() as $date) {
  echo "{$date->format('l, Y-m-d')}:\n";
  echo "{$date->getEvents()}:\n";
}

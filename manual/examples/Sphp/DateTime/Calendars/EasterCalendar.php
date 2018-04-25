<?php

namespace Sphp\DateTime\Calendars;

$easterCalendar = new EasterCalendar();

foreach (EasterCalendar::build() as $date) {
  echo "{$date->format('l, Y-m-d')}:\n";
  echo "{$date->getNotes()}:\n";
}

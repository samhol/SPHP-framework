<?php

namespace Sphp\I18n\Datetime;

$now = new DateTime();
$lastTuesday = DateTime::fromString('last tuesday');
$date = DateTime::fromFormat('Y-m-d H:i:s', '2009-02-15 15:16:17');

echo "$now is " . $now->getWeekdayName() . ' and the week number is ' . $now->getWeekOfYear() . "\n";

echo $now->strftime("%A %e %B %G %H:%M:%S %Z\n", 'sv_FI.utf-8') . "\n";
echo $now->strftime("%A %e %B %G %H:%M:%S %Z", 'fi_FI.utf-8') . "\n";

echo $date->formatICU('d. MMMM y HH:mm.ss ZZZZ', 'fi_FI.utf-8') . "\n";

echo $now->formatICU('d. MMMM y HH:mm.ss ZZZZ', 'fi_FI.utf-8') . "\n";
echo $now->formatICU('d. MMMM y HH:mm.ss, z Q', 'en_US.utf-8') . "\n";
echo $lastTuesday->formatICU('EEEE d.MMMM y HH:mm.s VVVV', 'fi_FI.utf-8') . "\n";
echo $lastTuesday->formatICU('eeee d.MMMM y HH:mm.ss VVVV', 'de-DE.utf-8');

var_dump(CalendarUtils::getWeekdayNames());

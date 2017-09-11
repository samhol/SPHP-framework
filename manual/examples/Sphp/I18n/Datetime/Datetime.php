<?php

namespace Sphp\I18n\Datetime;

$now = new DateTime();
$lastTuesday = DateTime::fromString('last tuesday');

echo $now->getWeekdayName() . "\n";
echo $now->getMonthName() . "\n";

echo $now->strftime("%A %e %B %G %H:%M:%S %Z\n", 'sv_FI.utf-8') . "\n";
echo $now->strftime("%A %e %B %G %H:%M:%S %Z", 'fi_FI.utf-8') . "\n";


echo "\n" . $now->formatICU('d. MMMM y HH:mm.ss ZZZZ', 'fi_FI.utf-8');
echo "\n" . $now->formatICU('d. MMMM y HH:mm.ss, z Q', 'en_US.utf-8');
echo "\n" . $lastTuesday->formatICU('EEEE d.MMMM y HH:mm.s VVVV', 'fi_FI.utf-8');
echo "\n" . $lastTuesday->formatICU('eeee d.MMMM y HH:mm.ss VVVV', 'de-DE.utf-8');

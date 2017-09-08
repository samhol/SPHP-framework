<?php

namespace Sphp\I18n\Datetime;

$dateTime = CalendarDate::fromTimestamp(4365364);
$dateTime->getTranslator()->setLang('fi_FI');
echo $dateTime->getWeekdayName() . "\n";
echo $dateTime->getMonthName() . "\n";
echo $dateTime->getFiDate() . "\n";
echo $dateTime->getFiDateTime() . "\n";

echo $dateTime->strftime("%A %e %B %G %H:%M:%S",'fr_CA') . "\n";
echo $dateTime->strftime("%A %e %B %G %H:%M:%S",'fi_FI') . "\n";

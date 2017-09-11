<?php

namespace Sphp\I18n\Datetime;

$dateTime = CalendarDate::fromTimestamp(436544364);

echo $dateTime->getWeekdayName() . "\n";
echo $dateTime->getMonthName() . "\n";

echo $dateTime->strftime("%A %e %B %G %H:%M:%S %Z\n", 'sv-FI') . "\n";
echo $dateTime->strftime("%A %e %B %G %H:%M:%S %Z", 'fi_FI') . "\n";

use IntlDateFormatter;

$fmt = new IntlDateFormatter(
        'fi-FI',
        IntlDateFormatter::FULL, IntlDateFormatter::FULL,
        'America/Los_Angeles',
        IntlDateFormatter::GREGORIAN,
        'MM/dd/yyyy'
);
echo "\n" . $fmt->getPattern();
echo "\n" . $fmt->format(0);
$fmt->setPattern('yyyymmdd hh:mm:ss z');
echo "\n". $fmt->getPattern();
echo "\n" . $fmt->format(0);
$fmt = datefmt_create(
    'de-DE',
    IntlDateFormatter::FULL,
    IntlDateFormatter::FULL,
    'America/Los_Angeles',
    IntlDateFormatter::GREGORIAN,
    'MMMM/DDDD/yyyy eeee'
);
echo "\n" . datefmt_format($fmt, 0);

$fmt = datefmt_create(
    'fi_FI',
    IntlDateFormatter::FULL,
    IntlDateFormatter::FULL,
    'Europe/Helsinki',
    IntlDateFormatter::GREGORIAN
);
echo "\n" . datefmt_format($fmt, time());

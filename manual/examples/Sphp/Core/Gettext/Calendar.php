<?php

namespace Sphp\Core\Gettext;

Locale::setMessageLocale("fi_FI");
$calendar = new Calendar();
echo "Tänään: " . $calendar->getWeekdayName(date("N"));
echo " " . $calendar->getMonthName(date("n"));
Locale::setMessageLocale("en_US");
echo "\nToday: " . $calendar->getWeekdayName(date("N"));
echo " " . $calendar->getMonthName(date("n"));

Locale::setMessageLocale("fi_FI");
echo "\nWeekdays: ";
foreach ($calendar->getWeekdays() as $dn => $wd) {
	echo " $wd";
}

echo "\nMonth abbreviations:";
foreach ($calendar->getMonths(3) as $m) {
	echo " $m";
}

echo "\nMonths:";
foreach ($calendar->getMonths() as $m) {
	echo " $m";
}
?>
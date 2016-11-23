<?php

namespace Sphp\Core\I18n;

$calendar = (new Calendar())->setLang('fi_FI');
echo "Tänään: " . $calendar->getWeekdayName(date("N"));
echo " " . $calendar->getMonthName(date("n"));
$calendar->setLang('en_US');
echo "\nToday: " . $calendar->getWeekdayName(date("N"));
echo " " . $calendar->getMonthName(date("n"));

$calendar->setLang('fi_FI');
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

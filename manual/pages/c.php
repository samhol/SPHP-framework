
<?php

$holidayData = [
    'y' => [
        1 => [
            1 => ["New Year's Day"],
            6 => ['Epiphany']
        ],
        5 => [
            1 => ['May Day']
        ],
        9 => [
            16 => ['My Birthday']
        ],
        11 => [
            '2 Sunday' => 'Fd'
        ],
        12 => [
            6 => ['Independence Day'],
            23 => ['Christmas Eve', "Ella's birthday"],
            24 => ['Christmas Eve', 'Birthday'],
            25 => ['Christmas Day'],
            26 => ['Boxing Day'],
            31 => ["New Year's Eve"],
        ]
    ],
];

use Sphp\Html\Apps\Calendars\WeekDayView;
use Sphp\DateTime\Date;
use Sphp\DateTime\Holidays;

$day = new WeekDayView(new Date());
echo $day;
$holidays = new Holidays($holidayData);
$m = new \Sphp\Html\Apps\Calendars\MonthView(2018, 12);
$m->setHolidays($holidays);
echo $m;


//$holidays = new Holidays($holidayData);
$holidays->get(Date::createFromString('2018-12-24'));
echo Holidays::getEasterSunday()->format('Y-m-d');

print_r($holidays->get(Date::createFromString('2018-12-24')));
print_r($holidays->get(Date::createFromString('2016-12-24')));
$date = Date::createFromString('2018-01-01');
echo "<pre>";
for ($i = 1; $i <= 365; ++$i) {
  // print_r($holidays->get($date));
  $date = $date->nextDate();
}


use Sphp\DateTime\EasterDays;

$e = new EasterDays();
$sp = new \Sphp\DateTime\FinnishHolidays(2018);

foreach ($sp as $d) {
  echo "\n$d";
}

echo "</pre>";

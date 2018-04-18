
<?php

use Sphp\Html\Apps\Calendars\WeekDayView;

$day = new WeekDayView(new DateTime('now'));
echo $day;
$m = new \Sphp\Html\Apps\Calendars\MonthView(2018, 4);
echo $m;
$wv = new \Sphp\Html\Apps\Calendars\WeekNumberView(new DateTime);

use Sphp\DateTime\Holidays;

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
$holidays = new Holidays($holidayData);
$holidays->get(new \DateTime('2018-12-24'));
echo Holidays::getEasterSunday()->format('Y-m-d');

print_r($holidays->get(new DateTime('2018-12-24')));
print_r($holidays->get(new DateTime('2016-12-24')));


$dtw = new \Sphp\DateTime\DateTimeWrapper();

echo "\n" . $dtw->getWeekDay();
echo "\n" . $dtw->getMonth();
echo "\n" . $dtw->getMonthDay();
echo "\n" . $dtw->getWeekDayName();
echo "\n" . $dtw->getMonthName();
echo "\n" . $dtw->getYear();
$ip = new DateTime('november 1st');

$ip->modify("next Sunday +7 days");

echo "\n" . $ip->format('Y-m-d l');
$jp = new DateTime('november 1st');

$jp->modify("next Saturday +7 days");

echo "\n" . $jp->format('Y-m-d l');

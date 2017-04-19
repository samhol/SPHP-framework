<?php

namespace Sphp\Net;

error_reporting(E_ALL);
ini_set('display_errors', '1');
date_default_timezone_set('Europe/Helsinki');
mb_internal_encoding('UTF-8');
//echo mb_internal_encoding();
include_once(__DIR__ . '/../../settings.php');

Headers::setContentType('application/json');


namespace Sphp\Core\Gettext;
use Sphp\Stdlib\Arrays;
var_dump(Locale::setMessageLocale('fi_FI'));
$calendar = new Calendar();
$messages = [
    'firstDOW' => 1,
    'labelTitle' => 'Valitse päivämäärä ja kellonaika',
    'labelYear' => 'year', 
    'labelMonth' => 'month', 
    'labelDayOfMonth' => 'day',
    'labelHour' => 'hours', 
    'labelMinute' => 'minutes',
    'labelSecond' => 'seconds',
    'dayAbbreviations' => Arrays::setSequential($calendar->getWeekdays(2, Calendar::SUN)),
    'dayNames' => Arrays::setSequential($calendar->getWeekdays(NULL, Calendar::SUN)),
    'monthAbbreviations' => $calendar->getMonths(3),
    'monthNames' => $calendar->getMonths()
];
//print_r(array_intersect($calendar->getWeekdays(NULL, Calendar::WED), $calendar->getWeekdays(NULL, Calendar::SUN)));
$translator = new Translator();
$translation = $translator->get($messages);
//print_R($messages);
echo json_encode($translation, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_NUMERIC_CHECK);

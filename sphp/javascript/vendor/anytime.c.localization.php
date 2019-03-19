<?php

namespace Sphp\Network\Headers;

error_reporting(E_ALL);
ini_set('display_errors', '1');
date_default_timezone_set('Europe/Helsinki');
mb_internal_encoding('UTF-8');
//echo mb_internal_encoding();
include_once(__DIR__ . '/../../settings.php');

Headers::contentType('application/json');

//namespace Sphp\I18n\Gettext;

use Sphp\Stdlib\Arrays;
use Sphp\Config\Locale;

var_dump(Locale::setMessageLocale('fi_FI'));

use Sphp\I18n\Datetime\CalendarUtils;

$cal = new CalendarUtils();
$messages = [
    'firstDOW' => 1,
    'labelTitle' => 'Valitse päivämäärä ja kellonaika',
    'labelYear' => 'year',
    'labelMonth' => 'month',
    'labelDayOfMonth' => 'day',
    'labelHour' => 'hours',
    'labelMinute' => 'minutes',
    'labelSecond' => 'seconds',
    'dayAbbreviations' => Arrays::setSequential($cal->getWeekdays(2)),
    'dayNames' => Arrays::setSequential($cal->getWeekdays()),
    'monthAbbreviations' => Arrays::setSequential($cal->getMonths(3)),
    'monthNames' => Arrays::setSequential($cal->getMonths())
];

use Sphp\I18n\Zend\Translator;

//print_r(array_intersect($calendar->getWeekdays(NULL, Calendar::WED), $calendar->getWeekdays(NULL, Calendar::SUN)));
$translator = Translator::fromFilePattern('gettext', 'sphp/locale/', '%s/LC_MESSAGES/Sphp.Datetime.mo', 'Sphp.Datetime');
$translator->setUsedDomain("Sphp.Datetime")->setLang('fi_FI');
$translation = $translator->translateArray($messages);
print_r($messages);
//echo json_encode($messages, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_NUMERIC_CHECK);
echo json_encode($translation, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_NUMERIC_CHECK);

<?php

namespace Sphp\Http\Headers;

use Sphp\I18n\Zend\Translator;

error_reporting(E_ALL);
ini_set('display_errors', '1');
date_default_timezone_set('Europe/Helsinki');
mb_internal_encoding('UTF-8');
//echo mb_internal_encoding();
include_once(__DIR__ . '/../settings.php');

Headers::setContentType('application/json');

//namespace Sphp\I18n\Gettext;

use Sphp\Stdlib\Arrays;
use Sphp\Config\Locale;

$lang = filter_input(INPUT_GET, 'lang', FILTER_SANITIZE_STRING);
if ($lang !== null) {
  Locale::setMessageLocale($lang);
  //var_dump(Locale::setMessageLocale($lang));
}

use Sphp\I18n\Datetime\CalendarUtils;
$translator = Translator::fromFilePattern('gettext', 'sphp/locale/', '%s/LC_MESSAGES/Sphp.Defaults.mo', 'Sphp.Defaults');
$translator->setUsedDomain("Sphp.Defaults")->setLang('fi_FI');
echo $translator->getLang('Monday');
echo $translator->get('Monday');
$cal = new CalendarUtils($translator);
$messages = [
    'foo' => $lang,
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


//print_r(array_intersect($calendar->getWeekdays(NULL, Calendar::WED), $calendar->getWeekdays(NULL, Calendar::SUN)));
$translation = $translator->translateArray($messages);
//print_r($messages);
//echo json_encode($messages, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_NUMERIC_CHECK);
echo json_encode($translation, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_NUMERIC_CHECK);

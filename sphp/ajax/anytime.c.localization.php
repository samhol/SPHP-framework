<?php

namespace Sphp\Network\Headers;

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
use Sphp\Stdlib\Filesystem;

$lang = filter_input(INPUT_GET, 'lang', FILTER_SANITIZE_STRING);
$heading = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING);
if ($lang === null) {
  $lang = 'en_US';
  //Locale::setMessageLocale($lang);
  //var_dump(Locale::setMessageLocale($lang));
}

use Sphp\I18n\Datetime\CalendarUtils;

//$t = new gt('Sphp.Defaults', 'sphp/locale');
//
//$t->setLang('fi_FI');
//echo $t->get('Monday');
//echo Filesystem::getFullPath(__DIR__.'/../locale/');
$translator = Translator::fromFilePattern('gettext', Filesystem::getFullPath(__DIR__ . '/../locale/'), '%s/LC_MESSAGES/Sphp.Datetime.mo', 'Sphp.Datetime')
        ->setUsedDomain('Sphp.Datetime')
        ->setLang($lang);
//echo $translator->getLang('Monday');
//echo $translator->get('Monday');
$cal = new CalendarUtils($translator);
$cal->setFirstDayOfWeek(CalendarUtils::SUN);
$messages = [
    //'foo' => $lang,
    //'locale' => Locale::getMessageLocale(),
    //'firstDOW' => 1,
    'labelTitle' => 'Select a Date and Time',
    'labelYear' => 'year',
    'labelMonth' => 'month',
    'labelDayOfMonth' => 'day',
    'labelHour' => 'hours',
    'labelMinute' => 'minutes',
    'labelSecond' => 'seconds',
];
$messages['dayAbbreviations'] = $cal->getWeekdays(2);
$messages['dayNames'] = $cal->getWeekdays();
$messages['monthAbbreviations'] = Arrays::setSequential($cal->getMonths(3));
$messages['monthNames'] = Arrays::setSequential($cal->getMonths());


//print_r(array_intersect($calendar->getWeekdays(NULL, Calendar::WED), $calendar->getWeekdays(NULL, Calendar::SUN)));
$translation = $translator->translateArray($messages);
//print_r($messages);
//echo json_encode($messages, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_NUMERIC_CHECK);
echo json_encode($translation, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_NUMERIC_CHECK);

<?php

namespace Sphp\I18n\Datetime;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$ns = Apis::sami()->namespaceBreadGrumbs(__NAMESPACE__);
$calendarDate = Apis::sami()->classLinker(DateTime::class);
$calendar = Apis::sami()->classLinker(Calendar::class);
\Sphp\Manual\parseDown(<<<MD
##Localized datetime and calendar translations
$ns
The $calendar class and  $calendarDate class and the .
MD
);
//CodeExampleBuilder::visualize('Sphp/I18n/Datetime/Calendar.php', 'text', false);

CodeExampleBuilder::visualize('Sphp/I18n/Datetime/Datetime.php', 'text', false);

<?php

namespace Sphp\I18n\Datetime;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleAccordionBuilder;
use Sphp\Html\Apps\Manual\Apis;

$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$calendarDate = \Sphp\Manual\api()->classLinker(DateTime::class);
\Sphp\Manual\md(<<<MD
##Localized datetime and calendar translations
$ns
The $calendarDate supports following methods for Date and Time localization.
MD
);

CodeExampleAccordionBuilder::visualize('Sphp/I18n/Datetime/Datetime.php', 'text', false);

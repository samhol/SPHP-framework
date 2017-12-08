<?php

namespace Sphp\I18n\Datetime;

use Sphp\Manual;

$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$calendarDate = Manual\api()->classLinker(DateTime::class);
Manual\md(<<<MD
##Localized datetime and calendar translations
$ns
The $calendarDate supports following methods for Date and Time localization.
MD
);

Manual\visualize('Sphp/I18n/Datetime/Datetime.php', 'text', false);

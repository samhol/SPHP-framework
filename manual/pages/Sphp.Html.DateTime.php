<?php

namespace Sphp\Html\DateTime;

use Sphp\Manual;

$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

$factory = Manual\api()->classLinker(Factory::class);

Manual\md(<<<MD
#HTML DateTime management
$ns 
Time tags can be created by using static method defined in $factory class

MD
);

Manual\visualize('Sphp/Html/DateTime/Factory.php', 'html5');
Manual\loadPage('Sphp.Html.DateTime.Calendars');

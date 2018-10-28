<?php

namespace Sphp\DateTime;

use Sphp\Manual;

$date = Manual\api()->classLinker(Date::class);
$dateInterface = Manual\api()->classLinker(DateInterface::class);
$dateTimeLink = Manual\api()->classLinker(DateTime::class);
$namespaces = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$dateTimeImmutable = Manual\php()->classLinker(\DateTimeImmutable::class);
Manual\md(<<<MD
#Date and Time
$namespaces
PHP has a variety of functions and classes that can handle date andd time related 
operations. This namespace introduces some addons to these native properties.

MD
);

Manual\printPage('Sphp.DateTime.DateTimeInterface');
Manual\printPage('Sphp.DateTime.PeriodInterface');
Manual\printPage('Sphp.DateTime.IntervalInterface');

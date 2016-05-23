<?php

namespace Sphp\Util;

use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;

$parentDatetime = $php->getClassLink(\DateTime::class);
$datetime = $api->getClassLink(Datetime::class);
echo $parsedown->text(<<<MD
##The $datetime class extends the build-in $parentDatetime class

$datetime class introduces some improvements to the PHP's $parentDatetime class. 
The datetime class implements for example several comparison methods for 
comparing different dates and times to one another.
MD
);

(new CodeExampleAccordion(EXAMPLE_DIR . "Sphp/Util/Datetime.php", "php", false))
		->setExampleHeading("Comparisons example PHP code")
		->setOutputPaneTitle("Comparison results")
		->printHtml();

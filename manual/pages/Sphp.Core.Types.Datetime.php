<?php

namespace Sphp\Core\Types;

use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;

$parentDatetime = $php->classLinker(\DateTime::class);
$datetime = $api->classLinker(Datetime::class);
echo $parsedown->text(<<<MD
##The $datetime class extends the build-in $parentDatetime class

$datetime class introduces some improvements to the PHP's $parentDatetime class. 
The datetime class implements for example several comparison methods for 
comparing different dates and times to one another.
MD
);

(new CodeExampleAccordion(EXAMPLE_DIR . "Sphp/Core/Types/Datetime.php", "text", false))
		->setExampleHeading("Comparisons example PHP code")
		->setOutputPaneTitle("Comparison results")
		->printHtml();

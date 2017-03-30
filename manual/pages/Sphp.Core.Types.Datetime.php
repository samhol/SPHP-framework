<?php

namespace Sphp\Stdlib;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

$parentDatetime = $php->classLinker(\DateTime::class);
$datetime = $api->classLinker(Datetime::class);
echo $parsedown->text(<<<MD
##The $datetime class extends the build-in $parentDatetime class

$datetime class introduces some improvements to the PHP's $parentDatetime class. 
The datetime Implements for example several comparison methods for 
comparing different dates and times to one another.
MD
);

(new CodeExampleBuilder("Sphp/Core/Types/Datetime.php", "text", false))
		->setExamplePaneTitle("Comparisons example PHP code")
		->setOutputPaneTitle("Comparison results")
		->printHtml();

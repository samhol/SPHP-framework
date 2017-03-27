<?php

namespace Sphp\Stdlib;

use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;
use Sphp\Html\Apps\Manual\Apis;
$strLink = Apis::phpManual()->typeLink('string');
$strings = Apis::apigen()->classLinker(Strings::class);
echo $parsedown->text(<<<MD
##The $strings class

$strings class is a static utility class for multibyte PHP $strLink comparison and matching.
MD
);
(new CodeExampleAccordion(EXAMPLE_DIR . "Sphp/Core/Types/Strings1.php", "text", false))
		->setExampleHeading("Multibyte String testing example")
		->setOutputSyntaxPaneTitle("String testing results")
		->printHtml();
echo $parsedown->text(<<<MD
$strings class has also a couple of handy PHP $strLink manipulation functions.
MD
);
(new CodeExampleAccordion(EXAMPLE_DIR . "Sphp/Core/Types/Strings2.php", "text", false))
		->setExampleHeading("Multibyte String manipulation example")
		->setOutputSyntaxPaneTitle("String manipulation results")
		->printHtml();

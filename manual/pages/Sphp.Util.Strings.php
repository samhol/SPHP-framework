<?php

namespace Sphp\Util;

use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;

$strLink = $php->getTypeLink("string");
$StringsLink = $api->getClassLink(Strings::class);
echo $parsedown->text(<<<MD
##The $StringsLink class

$StringsLink class is a static utility class for multibyte PHP $strLink comparison and matching.
MD
);

(new CodeExampleAccordion(EXAMPLE_DIR . "Sphp/Util/Strings1.php", "php", false))
		->setExampleHeading("String testing example PHP code")
		->setOutputSyntaxPaneTitle("String testing results")
		->printHtml();
echo $parsedown->text(<<<MD
$StringsLink class has also a couple of handy PHP $strLink manipulation functions.
MD
);
(new CodeExampleAccordion(EXAMPLE_DIR . "Sphp/Util/Strings2.php", "php", false))
		->setExampleHeading("String manipulation example PHP code")
		->setOutputSyntaxPaneTitle("String manipulation results")
		->printHtml();

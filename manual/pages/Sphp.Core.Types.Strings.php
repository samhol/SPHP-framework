<?php

namespace Sphp\Core\Types;

use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;

$strLink = $php->getTypeLink("string");
$StringsLink = $api->getClassLink(Strings::class);
echo $parsedown->text(<<<MD
##The $StringsLink class

$StringsLink class is a static utility class for multibyte PHP $strLink comparison and matching.
MD
);

(new CodeExampleAccordion(EXAMPLE_DIR . "Sphp/Core/Types/Strings1.php", "text", false))
		->setExampleHeading("Multibyte String testing example")
		->setOutputSyntaxPaneTitle("String testing results")
		->printHtml();
echo $parsedown->text(<<<MD
$StringsLink class has also a couple of handy PHP $strLink manipulation functions.
MD
);
(new CodeExampleAccordion(EXAMPLE_DIR . "Sphp/Core/Types/Strings2.php", "text", false))
		->setExampleHeading("Multibyte String manipulation example")
		->setOutputSyntaxPaneTitle("String manipulation results")
		->printHtml();

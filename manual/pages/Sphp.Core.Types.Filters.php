<?php

namespace Sphp\Core\Filters;

use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;

$strLink = $php->typeLink("string");
$arrLink = $php->typeLink([]);
$filterInterfaceLink = $api->classLinker(FilterInterface::class);
$nsbc = $api->namespaceBreadGrumbs(__NAMESPACE__);
$nsLink = $api->namespaceLink(__NAMESPACE__);
echo $parsedown->text(<<<MD
##Customizable value filtering
$nsbc
PHP has a variety of functions and classes that can handle data filering. SPHP 
framework offers an customizable object oriented extension to Data Filtering.

All $filterInterfaceLink implementations should accept any type of input variable.
		
The $filterInterfaceLink is the base interface for all variable filtering. What 
the actual filtering does in particular case is totally up to the implementator. 
Build-in filters focus on manipulatong scalar values like strings and numeric values.

MD
);

(new CodeExampleAccordion(EXAMPLE_DIR . "Sphp/Core/Types/Filters/FilterAggregate.php", "text", false))
		->setExampleHeading("Array filtering example")
		->setOutputSyntaxPaneTitle("Array filtering results")
		->printHtml();
(new CodeExampleAccordion(EXAMPLE_DIR . "Sphp/Core/Types/Filters/StringFiltering.php", "text", false))
		->setExampleHeading("String filtering example")
		->setOutputSyntaxPaneTitle("String filtering results")
		->printHtml();
echo $parsedown->text(<<<MD
$filterInterfaceLink can easily be used for filtering PHP $arrLink values.
MD
);
(new CodeExampleAccordion(EXAMPLE_DIR . "Sphp/Core/Types/Filters/ArrayFiltering.php", "text", false))
		->setExampleHeading("Array filtering example")
		->setOutputSyntaxPaneTitle("Array filtering results")
		->printHtml();

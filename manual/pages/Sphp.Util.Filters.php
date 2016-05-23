<?php

namespace Sphp\Util\Filters;

use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;

$strLink = $php->getTypeLink("string");
$arrLink = $php->getTypeLink([]);
$filterInterfaceLink = $api->getClassLink(FilterInterface::class);
$nsLink = $api->getNamespaceLink(__NAMESPACE__);
echo $parsedown->text(<<<MD
##Customized Data Filtering with PHP and SPHP
	
PHP has a variety of functions and classes that handle data filering in various 
problem domains. SPHP framework is not trying to replace these but simply to 
offer an customizable object oriented extension to Data Filtering.

All $filterInterfaceLink implementations should accept any type of input variable.
		
The $filterInterfaceLink is the base interface for all variable filtering. What 
the actual filtering does in particular case is totally up to the implementator. 
Build-in filters focus on manipulatong scalar values like strings and numeric values.

MD
);

(new CodeExampleAccordion(EXAMPLE_DIR . "Sphp/Util/Filters/StringFiltering.php", "php", false))
		->setExampleHeading("String filtering example PHP code")
		->setOutputSyntaxPaneTitle("String filtering results")
		->printHtml();
echo $parsedown->text(<<<MD
$filterInterfaceLink can easily be used for filtering PHP $arrLink values.
MD
);
(new CodeExampleAccordion(EXAMPLE_DIR . "Sphp/Util/Filters/ArrayFiltering.php", "php", false))
		->setExampleHeading("Array filtering example PHP code")
		->setOutputSyntaxPaneTitle("Array filtering results")
		->printHtml();

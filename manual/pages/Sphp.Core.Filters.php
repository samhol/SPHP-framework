<?php

namespace Sphp\Core\Filters;

use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion;

$strLink = $php->typeLink("string");
$arrLink = $php->typeLink([]);
$filterInterface = $api->classLinker(FilterInterface::class);
$filterAggregate = $api->classLinker(FilterAggregate::class);
$nsbc = $api->namespaceBreadGrumbs(__NAMESPACE__);
$nsLink = $api->namespaceLink(__NAMESPACE__, false);
echo $parsedown->text(<<<MD
#Customizable value filtering
$nsbc
PHP has a variety of functions and classes that can handle data filering. Interfaces and Classes in $nsLink
namespace gives a simple object oriented extension to these native filters.
	
The $filterInterface is the base interface for all variable filtering. What 
the actual filtering does in particular case is totally up to the implementator. 
Build-in filters focus on manipulatong scalar values like strings and numeric values.
MD
);
(new CodeExampleAccordion(EXAMPLE_DIR . "Sphp/Core/Filters/FilterInterface.php", "text", false))
		->setExampleHeading("String filtering example")
		->setOutputSyntaxPaneTitle("String filtering results")
		->printHtml();
echo $parsedown->text(<<<MD
##$filterAggregate filter

This filter is an aggregation of other individual filters. These filters can be 
anything that can be called as a function and of cource other classes implementing 
$filterInterface.
MD
);

(new CodeExampleAccordion(EXAMPLE_DIR . "Sphp/Core/Filters/FilterAggregate.php", "text", false))
		->setExampleHeading("Complex integer filtering example")
		->setOutputSyntaxPaneTitle("Array filtering results")
		->printHtml();
(new CodeExampleAccordion(EXAMPLE_DIR . "Sphp/Core/Filters/StringFiltering.php", "text", false))
		->setExampleHeading("String filtering example")
		->setOutputSyntaxPaneTitle("String filtering results")
		->printHtml();
echo $parsedown->text(<<<MD
$filterInterface can easily be used for filtering PHP $arrLink values.
MD
);
(new CodeExampleAccordion(EXAMPLE_DIR . "Sphp/Core/Filters/ArrayFiltering.php", "text", false))
		->setExampleHeading("Array filtering example")
		->setOutputSyntaxPaneTitle("Array filtering results")
		->printHtml();

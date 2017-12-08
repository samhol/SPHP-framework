<?php

namespace Sphp\Filters;

use Sphp\Manual;

$strLink = Manual\php()->typeLink("string");
$arrLink = Manual\php()->typeLink([]);
$filterInterface = Manual\api()->classLinker(FilterInterface::class);
$filterAggregate = Manual\api()->classLinker(FilterAggregate::class);
$nsbc = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$nsLink = Manual\api()->namespaceLink(__NAMESPACE__, false);

Manual\md(<<<MD
#Customizable value filtering
$nsbc
PHP has a variety of functions and classes that can handle data filering. Interfaces and Classes in $nsLink
namespace gives a simple object oriented extension to these native filters.
	
The $filterInterface is the base interface for all variable filtering. What 
the actual filtering does in particular case is totally up to the implementator. 
Build-in filters focus on manipulatong scalar values like strings and numeric values.
MD
);

Manual\example("Sphp/Filters/FilterInterface.php", "text", false)
        ->setExamplePaneTitle("String filtering example")
        ->setOutputSyntaxPaneTitle("String filtering results")
        ->printHtml();

Manual\md(<<<MD
##$filterAggregate filter

This filter is an aggregation of other individual filters. These filters can be 
anything that can be called as a function and of cource other classes implementing 
$filterInterface.
MD
);

Manual\example("Sphp/Filters/FilterAggregate.php", "text", false)
        ->setExamplePaneTitle("Complex integer filtering example")
        ->setOutputSyntaxPaneTitle("Array filtering results")
        ->printHtml();
Manual\example("Sphp/Filters/StringFiltering.php", "text", false)
        ->setExamplePaneTitle("String filtering example")
        ->setOutputSyntaxPaneTitle("String filtering results")
        ->printHtml();

Manual\md(<<<MD
$filterInterface can easily be used for filtering PHP $arrLink values.
MD
);

Manual\example("Sphp/Filters/ArrayFiltering.php", "text", false)
        ->setExamplePaneTitle("Array filtering example")
        ->setOutputSyntaxPaneTitle("Array filtering results")
        ->printHtml();

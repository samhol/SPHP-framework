<?php

namespace Sphp\Filters;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;
$strLink = Apis::phpManual()->typeLink("string");
$arrLink = Apis::phpManual()->typeLink([]);
$filterInterface = \Sphp\Manual\api()->classLinker(FilterInterface::class);
$filterAggregate = \Sphp\Manual\api()->classLinker(FilterAggregate::class);
$nsbc = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$nsLink = \Sphp\Manual\api()->namespaceLink(__NAMESPACE__, false);
\Sphp\Manual\parseDown(<<<MD
#Customizable value filtering
$nsbc
PHP has a variety of functions and classes that can handle data filering. Interfaces and Classes in $nsLink
namespace gives a simple object oriented extension to these native filters.
	
The $filterInterface is the base interface for all variable filtering. What 
the actual filtering does in particular case is totally up to the implementator. 
Build-in filters focus on manipulatong scalar values like strings and numeric values.
MD
);
(new CodeExampleBuilder("Sphp/Filters/FilterInterface.php", "text", false))
		->setExamplePaneTitle("String filtering example")
		->setOutputSyntaxPaneTitle("String filtering results")
		->printHtml();
\Sphp\Manual\parseDown(<<<MD
##$filterAggregate filter

This filter is an aggregation of other individual filters. These filters can be 
anything that can be called as a function and of cource other classes implementing 
$filterInterface.
MD
);

(new CodeExampleBuilder("Sphp/Filters/FilterAggregate.php", "text", false))
		->setExamplePaneTitle("Complex integer filtering example")
		->setOutputSyntaxPaneTitle("Array filtering results")
		->printHtml();
(new CodeExampleBuilder("Sphp/Filters/StringFiltering.php", "text", false))
		->setExamplePaneTitle("String filtering example")
		->setOutputSyntaxPaneTitle("String filtering results")
		->printHtml();
\Sphp\Manual\parseDown(<<<MD
$filterInterface can easily be used for filtering PHP $arrLink values.
MD
);
(new CodeExampleBuilder("Sphp/Filters/ArrayFiltering.php", "text", false))
		->setExamplePaneTitle("Array filtering example")
		->setOutputSyntaxPaneTitle("Array filtering results")
		->printHtml();

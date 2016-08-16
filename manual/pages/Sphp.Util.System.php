<?php

namespace Sphp\Util;

use Sphp\Html\Apps\SyntaxHighlightingAccordion as SyntaxHighlighter;
use Sphp\Html\Apps\ApiTools\ExampleViewer as ExampleViewer;

//$config = $api->classLinker(\Sphp\Core\Config::class);
$toolsLink = $api->namespaceLink(__NAMESPACE__);
$boolLink = $php->typeLink("boolean");
$intLink = $php->typeLink("integer");
$floatLink = $php->typeLink("float");
$strLink = $php->typeLink("string");
$arrLink = $php->typeLink("array");
$arrayAccess = $php->classLinker(\ArrayAccess::class);
echo $parsedown->text(<<<MD
#Miscellaneous classes in $toolsLink namespace
        
MD
);

//$load("Sphp.Util.ErrorHandling.php");
$load("Sphp.Util.System.fileManipulation.php");

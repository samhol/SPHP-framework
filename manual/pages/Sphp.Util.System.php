<?php

namespace Sphp\Util;

use Sphp\Html\Apps\SyntaxHighlightingAccordion as SyntaxHighlighter;
use Sphp\Html\Apps\ApiTools\ExampleViewer as ExampleViewer;

//$config = $api->classLinker(\Sphp\Core\Config::class);
$toolsLink = $api->getNamespaceLink(__NAMESPACE__);
$boolLink = $php->getTypeLink("boolean");
$intLink = $php->getTypeLink("integer");
$floatLink = $php->getTypeLink("float");
$strLink = $php->getTypeLink("string");
$arrLink = $php->getTypeLink("array");
$arrayAccess = $php->classLinker(\ArrayAccess::class);
echo $parsedown->text(<<<MD
#Miscellaneous classes in $toolsLink namespace
        
MD
);

//$load("Sphp.Util.ErrorHandling.php");
$load("Sphp.Util.System.fileManipulation.php");

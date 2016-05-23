<?php

namespace Sphp\Html\Foundation\F6\Core;

use Sphp\Html\Apps\ApiTools\PHPExampleViewer as CodeExampleViewer;

$visibilityHandlingInterface = $api->classLinker(VisibilityHandlingInterface::class);
$visibilityHandlingTrait = $api->classLinker(VisibilityHandlingTrait::class);
$visibilityHandler = $api->classLinker(VisibilityHandler::class);
$ComponentInterface = $api->classLinker(\Sphp\Html\ComponentInterface::class);
$panel = $api->classLinker(\Sphp\Html\Foundation\Content\Panel::class);
$htmlComponent = $api->classLinker(\Sphp\Html\ComponentInterface::class);

$f_GridLink = $foundation->getComponentLink(Grid::class, "Foundation Grid layout");
echo $parsedown->text(<<<MD
##Components Visibility handling using Foundation Visibility CSS Classes 

Foundation framework introduces special Visibility CSS classes. With these classes 
it is possible to show or hide elements based on screen size or device orientation 
etc..

####$visibilityHandler component 

$visibilityHandlingInterface properties can be used directly in any $ComponentInterface implementation
by simply wrapping the object with a $visibilityHandler component.
MD
);
$ex1 = (new CodeExampleViewer(EXAMPLE_DIR . 'Sphp/Html/Foundation/Structure/VisibilityHandler.php'));
$ex1->getOutputViewer()->setCssClass("sphp-grid-example");
$ex1->printHtml();
echo $parsedown->text(<<<MD
####Visibility handling extending $visibilityHandlingInterface with the $visibilityHandlingTrait

$visibilityHandlingInterface is implemented in $panel component by using $visibilityHandlingTrait.
It can be also implemented in any custom component extending 
		
$visibilityHandlingInterface is implemented in $visibilityHandlingTrait trait.  implementator $visibilityHandler 
MD
);
$ex1->fromFile(EXAMPLE_DIR . 'Sphp/Html/Foundation/Structure/BlockGrid2.php')
		->printHtml();;





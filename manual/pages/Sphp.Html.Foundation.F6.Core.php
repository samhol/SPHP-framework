<?php

namespace Sphp\Html\Foundation\F6\Core; 

use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;
use Sphp\Html\Apps\Manual\Apis as Apis;
$visibilityHandlingInterface = $api->classLinker(VisibilityHandlingInterface::class);
$visibilityHandlingTrait = $api->classLinker(VisibilityHandlingTrait::class);
$visibilityHandler = $api->classLinker(VisibilityHandler::class);
$ComponentInterface = $api->classLinker(\Sphp\Html\ComponentInterface::class);
$htmlComponent = $api->classLinker(\Sphp\Html\ComponentInterface::class);
$callout = Apis::apigen()->classLinker(\Sphp\Html\Foundation\F6\Containers\Callout::class);

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
CodeExampleAccordion::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Core/VisibilityHandler.php');
echo $parsedown->text(<<<MD
####Visibility handling extending $visibilityHandlingInterface with the $visibilityHandlingTrait

$visibilityHandlingInterface is implemented in $callout component by using $visibilityHandlingTrait.
It can be also implemented in any custom component extending 
		
$visibilityHandlingInterface is implemented in $visibilityHandlingTrait trait.  implementator $visibilityHandler 
MD
);

CodeExampleAccordion::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Core/VisibilityHandler2.php');
echo $parsedown->text(<<<MD
####Visibility handling extending $visibilityHandlingInterface with the $visibilityHandlingTrait

$visibilityHandlingInterface is implemented in $callout component by using $visibilityHandlingTrait.
It can be also implemented in any custom component extending 
		
$visibilityHandlingInterface is implemented in $visibilityHandlingTrait trait.  implementator $visibilityHandler 
MD
);
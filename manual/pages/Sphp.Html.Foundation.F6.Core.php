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

echo $parsedown->text(<<<MD
#Components Visibility handling using Foundation Visibility CSS Classes 

Foundation framework introduces special Visibility CSS classes. With these classes 
it is possible to show or hide elements based on screen size or device orientation 
etc..
        
Valid screen size parameter values and corresponding screen widths:
 
 * ´small` for small screen (width: 0px - 640px)
 * ´medium` for medium screen (width: 641px - 1024px)
 * ´large` for large screen (width: 1025px - 1440px)
 * ´xlarge` for X-large screen (width: 1441px - 1920px)
 * ´xxlarge` for XX-large screen (width: 1921px...)

##$visibilityHandler component 

$visibilityHandlingInterface properties can be used directly in any $ComponentInterface implementation
by simply wrapping the object with a $visibilityHandler component.
MD
);
//CodeExampleAccordion::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Core/VisibilityHandler.php');
echo $parsedown->text(<<<MD
##Visibility handling extending $visibilityHandlingInterface with the $visibilityHandlingTrait

$visibilityHandlingInterface is implemented in $callout component by using $visibilityHandlingTrait.
It can be also implemented in any custom component extending 
		
$visibilityHandlingInterface is implemented in $visibilityHandlingTrait trait.  implementator $visibilityHandler 
MD
);

CodeExampleAccordion::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Core/VisibilityHandler2.php');
echo $parsedown->text(<<<MD
##Visibility handling extending $visibilityHandlingInterface with the $visibilityHandlingTrait

$visibilityHandlingInterface is implemented in $callout component by using $visibilityHandlingTrait.
It can be also implemented in any custom component extending 
		
$visibilityHandlingInterface is implemented in $visibilityHandlingTrait trait.  implementator $visibilityHandler 
MD
);

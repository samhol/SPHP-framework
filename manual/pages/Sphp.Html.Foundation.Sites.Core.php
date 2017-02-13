<?php

namespace Sphp\Html\Foundation\Sites\Core; 

use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;
use Sphp\Html\Apps\Manual\Apis;

$visibilityHandlingInterface = $api->classLinker(VisibilityHandlingInterface::class);
$visibilityHandler = $api->classLinker(VisibilityAdapter::class);
$ComponentInterface = $api->classLinker(\Sphp\Html\ComponentInterface::class);
$htmlComponent = $api->classLinker(\Sphp\Html\ComponentInterface::class);

echo $parsedown->text(<<<MD
#Changing component Visibility: <small>Foundation Visibility CSS Classes</small> 

Foundation framework introduces special Visibility CSS classes. With these classes 
it is possible to show or hide elements based on screen size or device orientation 
etc..
        
Valid screen size parameter values and corresponding screen widths:
 
 * `small` for small screen (width: 0px - 640px)
 * `medium` for medium screen (width: 641px - 1024px)
 * `large` for large screen (width: 1025px - 1440px)
 * `xlarge` for X-large screen (width: 1441px - 1920px)
 * `xxlarge` for XX-large screen (width: 1921px...)

##Implementing $visibilityHandlingInterface:  <small>The $visibilityHandler adapter</small>

$visibilityHandler provides a straightforward adapter for any $ComponentInterface component
to be used as a $visibilityHandlingInterface component.
MD
);
//CodeExampleAccordion::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Core/VisibilityHandler.php');
echo $parsedown->text(<<<MD
##Visibility handling extending $visibilityHandlingInterface 
MD
);

CodeExampleAccordion::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Core/VisibilityAdapter.php');
echo $parsedown->text(<<<MD
Hiding by Screen Size
        
MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Core/VisibilityAdapter-hideOnlyFor.php');
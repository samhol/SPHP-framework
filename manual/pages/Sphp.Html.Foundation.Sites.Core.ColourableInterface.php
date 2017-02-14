<?php

namespace Sphp\Html\Foundation\Sites\Core; 

use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;
use Sphp\Html\Apps\Manual\Apis;

$colourableInterface = Apis::apigen()->classLinker(ColourableInterface::class);
$colourableAdapter = Apis::apigen()->classLinker(ColourableAdapter::class);
$ComponentInterface = Apis::apigen()->classLinker(\Sphp\Html\ComponentInterface::class);

echo $parsedown->text(<<<MD
#Changing component Visibility: <small>Foundation Visibility CSS Classes</small> 

Foundation framework introduces special Visibility CSS classes. With these classes 
it is possible to show or hide elements based on screen size or device orientation 
etc..
        
Valid screen size parameter values and corresponding screen widths:
 
 * `primary` for small screen (width: 0px - 640px)
 * `secondary` for medium screen (width: 641px - 1024px)
 * `success` for large screen (width: 1025px - 1440px)
 * `warning` for X-large screen (width: 1441px - 1920px)
 * `alert` for XX-large screen (width: 1921px...)

##Implementing $colourableInterface:  <small>The $colourableAdapter adapter</small>

$colourableAdapter provides a straightforward adapter for any $ComponentInterface component
to be used as a $colourableInterface component.
MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Core/ColourableAdapter.php');

<?php

namespace Sphp\Html\Foundation\Sites\Core;

use Sphp\Manual;

$alingmentManager = Manual\api()->classLinker(AlingmentAdapter::class);

Manual\md(<<<MD
##Changing component alignment: <small>using $alingmentManager instance</small> 

Foundation framework introduces special alignment CSS classes. With these classes 
it is possible to show or hide elements based on screen size or device orientation 
etc..
        
Valid screen size parameter values and corresponding screen widths:
 
 * `small` for small screen (width: 0px - 640px)
 * `medium` for medium screen (width: 641px - 1024px)
 * `large` for large screen (width: 1025px - 1440px)
 * `xlarge` for X-large screen (width: 1441px - 1920px)
 * `xxlarge` for XX-large screen (width: 1921px...)


MD
);
Manual\example('Sphp/Html/Foundation/Sites/Core/AlignmentManager-horizontal.php', 'html5')
        ->buildAccordion()
        ->addCssClass('grid-example')->printHtml();

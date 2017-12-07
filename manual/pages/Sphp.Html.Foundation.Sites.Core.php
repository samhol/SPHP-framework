<?php

namespace Sphp\Html\Foundation\Sites\Core;

use Sphp\Manual;

$visibilityHandlingInterface = Manual\api()->classLinker(VisibilityChanger::class);
$visibilityHandler = Manual\api()->classLinker(VisibilityAdapter::class);
$ComponentInterface = Manual\api()->classLinker(\Sphp\Html\ComponentInterface::class);

Manual\md(<<<MD
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
Manual\md(<<<MD
##Visibility handling extending $visibilityHandlingInterface 
MD
);

Manual\example('Sphp/Html/Foundation/Sites/Core/VisibilityAdapter.php', 'html5')->printHtml();
Manual\md(<<<MD
Hiding by Screen Size
        
MD
);
Manual\example('Sphp/Html/Foundation/Sites/Core/VisibilityAdapter-hideOnlyFor.php')->printHtml();

Manual\loadPage('Sphp.Html.Foundation.Sites.Core.ColourableInterface');


Manual\loadPage('Sphp.Html.Foundation.Sites.Core.AlignmentManager');

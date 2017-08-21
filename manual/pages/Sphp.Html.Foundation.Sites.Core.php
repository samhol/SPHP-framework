<?php

namespace Sphp\Html\Foundation\Sites\Core; 

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$visibilityHandlingInterface = Apis::sami()->classLinker(VisibilityChanger::class);
$visibilityHandler = Apis::sami()->classLinker(VisibilityAdapter::class);
$ComponentInterface = Apis::sami()->classLinker(\Sphp\Html\ComponentInterface::class);

\Sphp\Manual\parseDown(<<<MD
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
\Sphp\Manual\parseDown(<<<MD
##Visibility handling extending $visibilityHandlingInterface 
MD
);

CodeExampleBuilder::visualize('Sphp/Html/Foundation/Sites/Core/VisibilityAdapter.php');
\Sphp\Manual\parseDown(<<<MD
Hiding by Screen Size
        
MD
);
CodeExampleBuilder::visualize('Sphp/Html/Foundation/Sites/Core/VisibilityAdapter-hideOnlyFor.php');


\Sphp\Manual\loadPage('Sphp.Html.Foundation.Sites.Core.ColourableInterface');

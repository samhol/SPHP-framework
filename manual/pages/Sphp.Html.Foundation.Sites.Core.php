<?php

namespace Sphp\Html\Foundation\Sites\Core;

use Sphp\Html\Foundation\Sites\Adapters\VisibilityAdapter;
use Sphp\Manual;

$visibilityHandlingInterface = Manual\api()->classLinker(VisibilityChanger::class);
$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

namespace Sphp\Html\Foundation\Sites\Adapters;
use Sphp\Manual;
$visibilityHandler = Manual\api()->classLinker(VisibilityAdapter::class);
$cssClassifiableContent = Manual\api()->classLinker(\Sphp\Html\CssClassifiableContent::class);

$adaptersNs = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);



Manual\md(<<<MD
#Component Visibility <small>by using Foundation Visibility CSS Classes</small> 
$ns
Foundation framework introduces special Visibility CSS classes. With these classes 
it is possible to show or hide elements based on screen size.
        
Valid screen size parameter values and corresponding screen widths:
 
 * `small` for screen widths: 0px - 640px
 * `medium` for screen widths: 641px - 1024px
 * `large` for screen widths: 1025px - 1440px
 * `xlarge` for screen widths: 1441px - 1920px
 * `xxlarge` for screen widths: 1921px...

##Implementing $visibilityHandlingInterface:  <small>The $visibilityHandler adapter</small>

$adaptersNs
$visibilityHandler provides a straightforward adapter for any $cssClassifiableContent object
to be used as a $visibilityHandlingInterface component.
MD
);

Manual\md(<<<MD
##Visibility handling extending $visibilityHandlingInterface  
{$visibilityHandler->methodLink('showFromUp')}

MD
);

Manual\example('Sphp/Html/Foundation/Sites/Adapters/VisibilityAdapter-showFromUp.php', 'html5')
        ->setExamplePaneTitle('Showing content for specific screen sizes or larger')
        ->setOutputSyntaxPaneTitle('Resulting HTML5 code')
        ->printHtml();

Manual\example('Sphp/Html/Foundation/Sites/Adapters/VisibilityAdapter-showOnlyFor.php', 'html5')
        ->setExamplePaneTitle('Showing content only for specific sceen size')
        ->setOutputSyntaxPaneTitle('Resulting HTML5 code')
        ->printHtml();
Manual\md(<<<MD
###Hiding Content <small>by Screen Size</small>
Hiding by Screen Size methods state which components should disappear based on the device's screen size.
MD
);
Manual\example('Sphp/Html/Foundation/Sites/Adapters/VisibilityAdapter-hideOnlyFor.php', 'html5')
        ->setExamplePaneTitle('Hiding content only for specific sceen size')
        ->setOutputSyntaxPaneTitle('Resulting HTML5 code')
        ->printHtml();

Manual\md(<<<MD
###Orientation Detection
  
It is also possible to Define content visibility by device orientation. This will change the visibility 
on mobile devices when the device is rotated. On desktop, the orientation is almost always reported as landscape.

MD
);
Manual\example('Sphp/Html/Foundation/Sites/Adapters/VisibilityHandler-deviceOrientation.php', 'html5')
        ->setExamplePaneTitle('Showing content based on Orientation Detection')
        ->setOutputSyntaxPaneTitle('Resulting HTML5 code')
        ->printHtml();


Manual\printPage('Sphp.Html.Foundation.Sites.Core.ColourableInterface');


Manual\printPage('Sphp.Html.Foundation.Sites.Core.AlignmentManager');

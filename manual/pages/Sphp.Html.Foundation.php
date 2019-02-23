<?php

namespace Sphp\Html\Foundation;

use Sphp\Manual;

$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

Manual\md(<<<MD
#Foundation for sites: <small>HTML front-end framework</small>
$ns
Foundation is a responsive front-end framework for web developement. It is 
included in SPHPlaygound framework and therefore also all of Foundation 
clientside properties are available. 
  
##Compatibility
Foundation is tested across many browsers and devices, and works back as far as IE9 and Android 2.

##What Won't Work?
        
 * The Grid: Foundation's grid uses box-sizing: border-box to apply gutters to columns, but this property isn't supported in IE8.
 * Desktop Styles: Because the framework is written mobile-first, browsers that don't support media queries will display the mobile styles of the site.
 * JavaScript: Our plugins use a number of handy ECMAScript 5 features that aren't supported in IE8.

##Here is a small collection of features available.
MD
);
//Manual\printPage('foundation-carousel');
//Manual\loadPage('Sphp.Html.Foundation.Sites');
Manual\printPage('Sphp.Html.Foundation-orbit-intro');

<?php

namespace Sphp\Html\Foundation;

use Sphp\Manual;

$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

Manual\md(<<<MD
#Foundation for sites: <small>a front-end framework for web developement</small>
$ns
Foundation is a responsive front-end framework for web developement. It is 
included in SPHPlaygound framework and therefore also all of Foundation 
clientside properties are available. Here is a small collection of features 
available.
MD
);
Manual\loadPage('foundation-carousel');
Manual\loadPage('Sphp.Html.Foundation.Sites');
Manual\loadPage('Sphp.Html.Foundation-orbit-intro');

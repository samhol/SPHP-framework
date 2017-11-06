<?php

namespace Sphp\Html\Foundation;

use Sphp\Html\Apps\Manual\Apis;

//$ns = $api->namespaceLink(__NAMESPACE__);
$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);


$sami = \Sphp\Manual\api();
$toolsLink = \Sphp\Manual\api()->namespaceLink(__NAMESPACE__, false);
\Sphp\Manual\parseDown(<<<MD
#Foundation for sites: <small> a front-end framework for web developement</small>
$ns
Foundation is a responsive front-end framework for web developement. It is included in SPHP framework and therefore also all of Foundation 
clientside properties are available. Here is a small collection of features available.
MD
);


\Sphp\Manual\loadPage('Sphp.Html.Foundation.Sites');


\Sphp\Manual\loadPage('Sphp.Html.Foundation-orbit-intro');

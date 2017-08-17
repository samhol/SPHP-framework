<?php

namespace Sphp\Html\Foundation;

use Sphp\Html\Apps\Manual\Apis;

//$ns = $api->namespaceLink(__NAMESPACE__);
$ns = Apis::sami()->namespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD
#Foundation front-end framework
        
$ns

Foundation framework is included in SPHP and therefore also all of Foundation 
clientside properties are available. Here is a small collection of features available.
MD
);
$load('Sphp.Html.Foundation-orbit-intro');

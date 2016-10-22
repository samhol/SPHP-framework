<?php

namespace Sphp\Html\Foundation\Sites\Media;

$ns = $api->namespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD
#Foundation 6 media components

$ns
        
This namespace contains components for handling different media types
using the tools provided by Foundation framework.
MD
);

$load("Sphp.Html.Foundation.F6.Media.Flex.php");
$load("Sphp.Html.Foundation.F6.Media.Orbit.php");
$load("Sphp.Html.Foundation.F6.Media.ProgressBar.php");

<?php

namespace Sphp\Html\Foundation\Sites\Media;

$ns = $api->namespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD
#Foundation media components

$ns
        
This namespace contains components for handling different media types
using the tools provided by Foundation framework.
MD
);

$load('Sphp.Html.Foundation.Sites.Media.Flex');
$load('Sphp.Html.Foundation.Sites.Media.Orbit');
$load('Sphp.Html.Foundation.Sites.Media.ProgressBar');

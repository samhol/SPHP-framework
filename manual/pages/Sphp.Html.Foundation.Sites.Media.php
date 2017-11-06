<?php

namespace Sphp\Html\Foundation\Sites\Media;

use Sphp\Html\Apps\Manual\Apis;

$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
\Sphp\Manual\parseDown(<<<MD
#Foundation media components

$ns
        
This namespace contains components for handling different media types
using the tools provided by Foundation framework.
MD
);

\Sphp\Manual\loadPage('Sphp.Html.Foundation.Sites.Media.ResponsiveEmbed');
\Sphp\Manual\loadPage('Sphp.Html.Foundation.Sites.Media.Orbit');
\Sphp\Manual\loadPage('Sphp.Html.Foundation.Sites.Media.ProgressBar');

<?php

namespace Sphp\Html\Foundation\Sites\Media;

use Sphp\Manual;

$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
Manual\md(<<<MD
#Foundation media components

$ns
        
This namespace contains components for handling different media types
using the tools provided by Foundation framework.
MD
);

Manual\printPage('Sphp.Html.Foundation.Sites.Media.ResponsiveEmbed');
Manual\printPage('Sphp.Html.Foundation.Sites.Media.Orbit');
Manual\printPage('Sphp.Html.Foundation.Sites.Media.ProgressBar');
Manual\printPage('Sphp.Html.Foundation.Sites.Media.Badge');

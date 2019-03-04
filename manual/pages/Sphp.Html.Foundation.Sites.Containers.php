<?php

namespace Sphp\Html\Foundation\Sites\Containers;

use Sphp\Manual;

$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

Manual\md(<<<MD
## Foundation containers
$ns
        
Namespace contains implementations of Foundation based containers.
MD
);

Manual\printPage('Sphp.Html.Foundation.Sites.Containers.Accordions');
Manual\printPage('Sphp.Html.Foundation.Sites.Containers.Tabs');
Manual\printPage('Sphp.Html.Foundation.Sites.Containers.Dropdown');
Manual\printPage('Sphp.Html.Foundation.Sites.Containers.Callout');
Manual\printPage('Sphp.Html.Foundation.Sites.Containers.Modals');
Manual\printPage('Sphp.Html.Foundation.Sites.Containers.OffCanvas');

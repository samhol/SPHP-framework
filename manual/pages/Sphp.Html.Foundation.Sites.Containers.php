<?php

namespace Sphp\Html\Foundation\Sites\Containers;
use Sphp\Html\Apps\Manual\Apis;

$accordion = \Sphp\Manual\api()->classLinker(Accordions\Pane::class);
$accordions = \Sphp\Manual\api()->classLinker(Accordions\Accordion::class);
$tabs = \Sphp\Manual\api()->classLinker(Tabs\Tabs::class);
$dropdown = \Sphp\Manual\api()->classLinker(Dropdown::class);
$modal = \Sphp\Manual\api()->classLinker(Modal::class);
$callout = \Sphp\Manual\api()->classLinker(Callout::class);
$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
\Sphp\Manual\md(<<<MD
#FOUNDATION CONTAINERS
$ns
This namespace contains Foundation framework based components like $accordions, $tabs, $callout, $modal and $dropdown.
MD
);
\Sphp\Manual\loadPage('Sphp.Html.Foundation.Sites.Containers.Accordions');
\Sphp\Manual\loadPage('Sphp.Html.Foundation.Sites.Containers.Tabs');
\Sphp\Manual\loadPage('Sphp.Html.Foundation.Sites.Containers.Dropdown');
\Sphp\Manual\loadPage('Sphp.Html.Foundation.Sites.Containers.Callout');
\Sphp\Manual\loadPage('Sphp.Html.Foundation.Sites.Containers.Modals');
\Sphp\Manual\loadPage('Sphp.Html.Foundation.Sites.Containers.OffCanvas');

<?php

namespace Sphp\Html\Foundation\Sites\Containers;

use Sphp\Manual;

$accordion = Manual\api()->classLinker(Accordions\Pane::class);
$accordions = Manual\api()->classLinker(Accordions\Accordion::class);
$tabs = Manual\api()->classLinker(Tabs\Tabs::class);
$dropdown = Manual\api()->classLinker(Dropdown::class);
$modal = Manual\api()->classLinker(Modal::class);
$callout = Manual\api()->classLinker(Callout::class);
$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

Manual\md(<<<MD
#Foundation containers
$ns
This namespace contains Foundation framework based components like $accordions, $tabs, $callout, $modal and $dropdown.
MD
);

Manual\loadPage('Sphp.Html.Foundation.Sites.Containers.Accordions');
Manual\loadPage('Sphp.Html.Foundation.Sites.Containers.Tabs');
Manual\loadPage('Sphp.Html.Foundation.Sites.Containers.Dropdown');
Manual\loadPage('Sphp.Html.Foundation.Sites.Containers.Callout');
Manual\loadPage('Sphp.Html.Foundation.Sites.Containers.Modals');
Manual\loadPage('Sphp.Html.Foundation.Sites.Containers.OffCanvas');

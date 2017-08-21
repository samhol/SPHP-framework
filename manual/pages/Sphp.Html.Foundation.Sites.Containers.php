<?php

namespace Sphp\Html\Foundation\Sites\Containers;
use Sphp\Html\Apps\Manual\Apis;

$accordion = Apis::sami()->classLinker(Accordions\Pane::class);
$accordions = Apis::sami()->classLinker(Accordions\Accordion::class);
$tabs = Apis::sami()->classLinker(Tabs\Tabs::class);
$dropdown = Apis::sami()->classLinker(Dropdown::class);
$modal = Apis::sami()->classLinker(Modal::class);
$callout = Apis::sami()->classLinker(Callout::class);
$ns = Apis::sami()->namespaceBreadGrumbs(__NAMESPACE__);
\Sphp\Manual\parseDown(<<<MD
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

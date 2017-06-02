<?php

namespace Sphp\Html\Foundation\Sites\Containers;

$accordion = $api->classLinker(Accordions\Pane::class);
$accordions = $api->classLinker(Accordions\Accordion::class);
$tabs = $api->classLinker(Tabs\Tabs::class);
$dropdown = $api->classLinker(Dropdown::class);
$modal = $api->classLinker(Modal::class);
$callout = $api->classLinker(Callout::class);
$ns = $api->namespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD
#FOUNDATION CONTAINERS
$ns
This namespace contains Foundation framework based components like $accordions, $tabs, $callout, $modal and $dropdown.
MD
);
$load('Sphp.Html.Foundation.Sites.Containers.Accordions');
$load('Sphp.Html.Foundation.Sites.Containers.Tabs');
$load('Sphp.Html.Foundation.Sites.Containers.Dropdown');
$load('Sphp.Html.Foundation.Sites.Containers.Callout');
$load('Sphp.Html.Foundation.Sites.Containers.Modals');
$load('Sphp.Html.Foundation.Sites.Containers.OffCanvas');

<?php

namespace Sphp\Html\Foundation\Sites\Containers;

$content_ns = $api->namespaceLink(__NAMESPACE__);
$accordion = $api->classLinker(Accordions\Pane::class);
$accordions = $api->classLinker(Accordions\Accordion::class);
$tabs = $api->classLinker(Tabs\Tabs::class);
$dropdown = $api->classLinker(Dropdown::class);
$modalReveal = $api->classLinker(Modals\Modal::class);
$callout = $api->classLinker(Callout::class);
$ns = $api->namespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD
#FOUNDATION CONTAINERS
$ns
This namespace contains Foundation framework based components like $accordions, $tabs, $callout, $modalReveal and $dropdown.
MD
);
$load("Sphp.Html.Foundation.Sites.Containers.Accordions.php");
$load("Sphp.Html.Foundation.Sites.Containers.Tabs.php");
$load("Sphp.Html.Foundation.Sites.Containers.Dropdown.php");
$load("Sphp.Html.Foundation.Sites.Containers.Callout.php");
$load("Sphp.Html.Foundation.Sites.Containers.Modals.php");
$load("Sphp.Html.Foundation.Sites.Containers.OffCanvas.php");

<?php

namespace Sphp\Html\Foundation\F6\Containers;

$content_ns = $api->getNamespaceLink(__NAMESPACE__);
$accordion = $api->classLinker(Accordions\Pane::class);
$accordions = $api->classLinker(Accordions\Accordion::class);
$tabs = $api->classLinker(Tabs\Tabs::class);
$dropdown = $api->classLinker(Dropdown::class);
$modalReveal = $api->classLinker(ModalReveal::class);
$callout = $api->classLinker(Callout::class);
$ns = $api->getNamespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD
#FOUNDATION CONTAINERS
$ns
This namespace contains Foundation framework based components like $accordions, $tabs, $callout, $modalReveal and $dropdown.
MD
);
$load("Sphp.Html.Foundation.F6.Containers.Accordions.php");
$load("Sphp.Html.Foundation.F6.Containers.Tabs.php");
$load("Sphp.Html.Foundation.F6.Containers.Dropdown.php");
$load("Sphp.Html.Foundation.F6.Containers.Callout.php");
//$load("Sphp.Html.Foundation.Content.ModalReveal.php");

//$load("Sphp.Html.Foundation.Media.php");

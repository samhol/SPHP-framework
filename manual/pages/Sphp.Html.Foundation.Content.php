<?php

namespace Sphp\Html\Foundation\Content;

$content_ns = $api->getNamespaceLink(__NAMESPACE__);
$accordion = $api->classLinker(Pane::class);
$accordions = $api->classLinker(Accordion::class);
$tabs = $api->classLinker(Tabs::class);
$dropdown = $api->classLinker(Dropdown::class);
$modalReveal = $api->classLinker(Popups\Popup::class);
$panel = $api->classLinker(Panel::class);
$flex = $api->classLinker(\Sphp\Html\Foundation\Media\FlexVideo::class);
$media_ns = $flex->namespaceLink();
echo $parsedown->text(<<<MD
#MISCELLANEOUS FOUNDATION COMPONENTS
##The $content_ns namespace
This namespace contains Foundation framework based components like $accordions, $tabs, $panel, $modalReveal and $dropdown.
MD
);
$load("Sphp.Html.Foundation.Content.Accordions.php");
$load("Sphp.Html.Foundation.Content.Tabs.php");
$load("Sphp.Html.Foundation.Content.Dropdown.php");
$load("Sphp.Html.Foundation.Content.Panel.php");
$load("Sphp.Html.Foundation.Content.ModalReveal.php");

$load("Sphp.Html.Foundation.Media.php");

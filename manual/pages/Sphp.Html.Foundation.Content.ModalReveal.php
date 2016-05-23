<?php

namespace Sphp\Html\Foundation\Content\Popups;

$popupWindow = $api->classLinker(Popup::class);
$closeButton = $api->classLinker(Popup::class);
$openButton = $api->classLinker(Popup::class);
$popup = $api->classLinker(Popup::class);
$ns = $api->getNamespaceLink(__NAMESPACE__, FALSE);
echo $parsedown->text(<<<MD
##Foundation popups: $ns namespace

This namespace contains components for creating and handling Foundation based pop-up windows.

###The $popupWindow component

This component represents the basic implementation of the Foundation Modal Reveal component.
MD
);
$exampleViewer(EXAMPLE_DIR . 'Sphp/Html/Foundation/Content/Popups/Popupper.php', 2);

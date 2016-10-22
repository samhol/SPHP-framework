<?php

namespace Sphp\Html\Foundation\Sites\Containers\OffCanvas;

use Sphp\Html\Foundation\Sites\Navigation\SubMenu as SubMenu;

$offCanvas = (new OffCanvas("Off-canvas"));
$offCanvas->leftMenu()
        ->appendLabel("Left Off-canvas menu")
        ->appendLink("http://www.google.com/", "Google", "_blank")
        ->appendLabel("Left Off-canvas menu")
        ->appendLink("http://www.google.com/", "Google", "_blank")
        ->appendLink("http://www.google.com/", "Google", "_blank")
        ->appendSubMenu()->appendLink("http://yahoo.com", "yahoo.com");
$offCanvas->rightMenu()
        ->appendLabel("Right Off-canvas menu")
        ->appendLink("http://www.google.com/", "Google", "_blank")
        ->appendLabel("label 1")
        ->appendLink("http://www.google.com/", "Google", "_blank")
        ->appendLink("http://www.google.com/", "Google", "_blank")
        ->appendSubMenu((new SubMenu("submenu"))->appendLink("http://yahoo.com", "yahoo.com"));
$offCanvas->mainContent()->append($offCanvas->leftMenu()->getMenuButton() . "offcanvas content", $offCanvas->rightMenu()->getMenuButton())
        ->ajaxAppend("manual/snippets/loremipsum.html");
$offCanvas->printHtml();
?>
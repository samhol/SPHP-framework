<?php

namespace Sphp\Html\Foundation\Sites\Containers\OffCanvas;

use Sphp\Html\Foundation\Sites\Navigation\SubMenu as SubMenu;

$offCanvas = (new OffCanvas("Off-canvas"));
$offCanvas->leftMenu()->append('left');
$offCanvas->rightMenu()->append('right');
$offCanvas->mainContent()->append($offCanvas->leftMenu()->getMenuButton('left'));

$offCanvas->printHtml();
?>

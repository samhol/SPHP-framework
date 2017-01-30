<?php

namespace Sphp\Html\Foundation\Sites\Containers\OffCanvas;

$offCanvas = (new OffCanvas('absolute'));
$offCanvas->leftMenu()->append('left');
$offCanvas->rightMenu()->append('right');
$offCanvas->mainContent()->append($offCanvas->leftMenu()->getMenuButton());
$offCanvas->mainContent()->append($offCanvas->rightMenu()->getMenuButton());
$offCanvas->mainContent()->append((new \Sphp\Html\Foundation\Sites\Bars\TitleBar())->append($offCanvas->leftMenu()->getMenuButton())->appendTitle('left title', 'l')->appendTitle('right title', 'r'));
$offCanvas->mainContent()->appendMdFile(\Sphp\Core\Path::get()->local('manual/snippets/loremipsum.md'));

$offCanvas->printHtml();
?>

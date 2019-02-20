<?php

namespace Sphp\Html\Foundation\Sites\Containers\OffCanvas;

use Sphp\Html\Foundation\Sites\Navigation\Bars\TitleBar;

$offCanvas = (new OffCanvas(OffCanvas::LEFT|OffCanvas::RIGHT));
$offCanvas->left()->append('left')->setPosition('absolute');
$offCanvas->right()->append('right')->setPosition('absolute');

$titlebar = new TitleBar();
$titlebar->left()->append($offCanvas->left()->getOpener());
$titlebar->right()->append($offCanvas->right()->getOpener());

$offCanvas->mainContent()->append($titlebar);
$offCanvas->mainContent()->appendMdFile('manual/snippets/loremipsum.md');

$offCanvas->printHtml();


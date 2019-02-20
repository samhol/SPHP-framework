<?php

namespace Sphp\Html\Foundation\Sites\Containers\OffCanvas;

use Sphp\Html\Foundation\Sites\Navigation\Bars\TitleBar;

$offCanvas = (new OffCanvas('absolute'));
$offCanvas->leftMenu()->append('left');
$offCanvas->rightMenu()->append('right');

$titlebar = new TitleBar();
$titlebar->left()->append($offCanvas->leftMenu()->getOpener());
$titlebar->right()->append($offCanvas->rightMenu()->getOpener());

$offCanvas->mainContent()->append($titlebar);
$offCanvas->mainContent()->appendMdFile('manual/snippets/loremipsum.md');

$offCanvas->printHtml();


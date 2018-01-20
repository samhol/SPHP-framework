<?php

namespace Sphp\Html\Foundation\Sites\Bars;

$bar = new TitleBar();
$bar->left()->setTitle('SPHP framework');
$bar->left()->setMenuButton((new MenuButton())->setAttribute('data-open', "bodyOffCanvas"));
$bar->right()->setMenuButton((new MenuButton())->setAttribute('data-open', "rightBodyOffCanvas"));
$bar->printHtml();

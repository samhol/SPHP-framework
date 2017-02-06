<?php

namespace Sphp\Html\Foundation\Sites\Bars;

$bar = new TitleBar();
$bar->left()->appendTitle('SPHP framework');
$bar->left()->setMenuButton((new MenuButton())->setAttr('data-open', "bodyOffCanvas"));
$bar->right()->setMenuButton((new MenuButton())->setAttr('data-open', "rightBodyOffCanvas"));
$bar->printHtml();
?>
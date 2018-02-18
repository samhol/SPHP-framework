<?php

namespace Sphp\Html\Foundation\Sites\Bars;

use Sphp\Html\Foundation\Sites\Bars\TitleBar;
$titlebar = new TitleBar();
$titlebar->left()->setTitle('Foo');
$titlebar->left()->setMenuButton(new MenuButton('foo'));
$titlebar->right()->setMenuButton(new MenuButton());
$titlebar->printHtml();


?>

<div class="title-bar">
  <div class="title-bar-left">
    <button class="button tiny" style="color: #999" type="button" data-open="offCanvasLeft"><i class="fas fa-bars"></i></button>
    <span class="title-bar-title">Foundation</span>
  </div>
  <div class="title-bar-right">
    <button class="menu-icon" type="button" data-open="offCanvasRight"></button>
  </div>
</div>

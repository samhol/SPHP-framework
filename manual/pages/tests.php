<?php

namespace Sphp\Html\Foundation\Sites\Bars;
use Sphp\Stdlib\Parser;

$data = Parser::fromFile('manual/snippets/icons/font-awesome.json');
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
<div class="sphp-brand-links">
  <a class="sphp-brand-link facebook rounded" href="#">
    <i class="fab fa-facebook-square"></i>
  </a>
  <a class="sphp-brand-link twitter" href="#">
    <i class="fab fa-twitter-square"></i>
  </a>
  <a class="sphp-brand-link github" href="#">
    <i class="fab fa-github-square"></i>
  </a>
</div>
<pre>
  <?php 
  use Sphp\Stdlib\Arrays;
  
  $fab = Arrays::isLike($data['icons'], 'fab ');
  print_r($fab);
  ?>
</pre>

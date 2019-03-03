<?php
namespace Sphp\Html\Foundation\Sites\Navigation;

$menu = new \Sphp\Html\Foundation\Sites\Navigation\BasicMenu();
$menu->setVertical()->setAttribute('data-responsive-menu','drilldown medium-accordion');
$menu->appendLink('/', 'foo');
$menu->appendLink('/', 'foo');
$menu->appendLink('/', 'foo');
$submenu = $menu->appendSubMenu()->setRoot('Item 3');
$submenu->appendLink("#Item3.1", "Item 3.1", "_self");
$submenu->appendLink("#Item3.2", "Item 3.2", "_self");
$submenu->appendLink("#Item3.3", "Item 3.3", "_self");
$submenu->appendLink("#Item3.4", "Item 3.4", "_self");
echo $menu;
?>


<ul class="vertical medium-horizontal menu" data-responsive-menu="accordion large-dropdown">
  <li>
    <a href="#">Item 1</a>
    <ul class="vertical menu">
      <li>
        <a href="#">Item 1A</a>
        <ul class="vertical menu">
          <li><a href="#">Item 1A</a></li>
          <li><a href="#">Item 1B</a></li>
          <li><a href="#">Item 1C</a></li>
          <li><a href="#">Item 1D</a></li>
          <li><a href="#">Item 1E</a></li>
        </ul>
      </li>
      <li><a href="#">Item 1B</a></li>
    </ul>
  </li>
  <li>
    <a href="#">Item 2</a>
    <ul class="vertical menu">
      <li><a href="#">Item 2A</a></li>
      <li><a href="#">Item 2B</a></li>
    </ul>
  </li>
  <li>
    <a href="#">Item 3</a>
    <ul class="vertical menu">
      <li><a href="#">Item 3A</a></li>
      <li><a href="#">Item 3B</a></li>
    </ul>
  </li>
</ul>
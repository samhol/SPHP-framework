<?php
namespace Sphp\Html\Foundation\Sites\Navigation;

include 'Sphp/Html/Foundation/Sites/Navigation/ResponsiveMenu.php';

\Sphp\Manual\visualize('Sphp/Html/Foundation/Sites/Navigation/ResponsiveMenu.php', 'html5');
?>

<h1>Foobar</h1>
<ul class="vertical medium-horizontal menu" data-responsive-menu="drilldown large-dropdown">
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
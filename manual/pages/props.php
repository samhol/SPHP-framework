<?php
$dd = \Sphp\Html\Foundation\Sites\Navigation\FlexibleMenu::createDrilldown()->addCssClass('sphp');
$dd->setOption('autoHeight', 'true');
$dd->setOption('animateHeight', 'true');
$sub1 = $dd->appendSubMenu();
$sub1->setRoot('sub1');
for ($i = 1; $i < 5; $i++) {
  $sub1->appendLink("#sub$i", "sub$i");
}
for ($i = 1; $i < 15; $i++) {
  $dd->appendLink("#foo$i", "foo$i");
}
//echo $dd;


use Sphp\Stdlib\Parsers\Parser;
echo '<pre>';
print_r(Parser::yaml()->readFromFile('/home/int48291/public_html/playground/manual/yaml/footer.yml'));
echo "</pre>";
?>

<h1>Foobar</h1>
<ul class="vertical menu sphp" data-options="autoHeight:true;animateHeight:true" data-responsive-menu="drilldown medium-accordion" data-auto-height="true" data-animate-height="true">
  <li><a href="#">One</a></li>
  <li><a href="#">One</a></li>
  <li>
    <a href="#">Two</a>
    <ul class="menu vertical nested">
      <li><a href="#">Two A</a></li>
      <li><a href="#">Two B</a></li>
      <li><a href="#">Two C</a></li>
      <li><a href="#">Two D</a></li>
    </ul>
  </li>
  <li>
    <a href="#">Two</a>
    <ul class="menu vertical nested">
      <li><a href="#">Two A</a></li>
      <li><a href="#">Two B</a></li>
      <li><a href="#">Two C</a></li>
      <li><a href="#">Two D</a></li>
      <li><a href="#">Two A</a></li>
      <li><a href="#">Two B</a></li>
      <li><a href="#">Two C</a></li>
      <li><a href="#">Two D</a></li>
      <li><a href="#">Two A</a></li>
      <li><a href="#">Two B</a></li>
      <li><a href="#">Two C</a></li>
      <li><a href="#">Two D</a></li>
      <li><a href="#">Two A</a></li>
      <li><a href="#">Two B</a></li>
      <li><a href="#">Two C</a></li>
      <li><a href="#">Two D</a></li>
      <li><a href="#">Two A</a></li>
      <li><a href="#">Two B</a></li>
      <li><a href="#">Two C</a></li>
      <li><a href="#">Two D</a></li>
    </ul>
  </li>
  <li><a href="#">Three</a></li>
  <li><a href="#">Four</a></li>
  <li><a href="#">Two A</a></li>
  <li><a href="#">Two B</a></li>
  <li><a href="#">Two C</a></li>
  <li><a href="#">Two D</a></li>
  <li><a href="#">Two A</a></li>
  <li><a href="#">Two B</a></li>
  <li><a href="#">Two C</a></li>
  <li><a href="#">Two D</a></li>
  <li><a href="#">Two A</a></li>
  <li><a href="#">Two B</a></li>
  <li><a href="#">Two C</a></li>
  <li><a href="#">Two D</a></li>
  <li><a href="#">Two A</a></li>
  <li><a href="#">Two B</a></li>
  <li><a href="#">Two C</a></li>
  <li><a href="#">Two D</a></li>
  <li><a href="#">Two A</a></li>
  <li><a href="#">Two B</a></li>
  <li><a href="#">Two C</a></li>
  <li><a href="#">Two D</a></li>
  <li><a href="#">Two A</a></li>
  <li><a href="#">Two B</a></li>
  <li><a href="#">Two C</a></li>
  <li><a href="#">Two D</a></li>
</ul>
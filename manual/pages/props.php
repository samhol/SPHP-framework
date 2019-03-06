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
$footerData = Parser::yaml()->readFromFile('/home/int48291/public_html/playground/manual/yaml/footer.yml');


//print_r(Parser::yaml()->readFromFile('/home/int48291/public_html/playground/manual/yaml/footer.yml'));
echo "</pre>";
$menu = \Sphp\Html\Foundation\Sites\Navigation\FlexibleMenu::createAccordion();
$menu->addCssClass('sphp');

use Sphp\Html\Foundation\Sites\Navigation\SubMenu;

class AccordionBuilder {

  private $menu;

  public function __construct(array $data) {
    $this->menu = \Sphp\Html\Foundation\Sites\Navigation\FlexibleMenu::createAccordion();
    $this->menu->addCssClass('sphp');
    foreach ($data['footer'] as $data) {
      echo '<pre>';
      print_r($data);
      echo "</pre>";
      $this->menu->appendSubMenu($this->group($data));
      
    }
  }

  public function group(array $data): SubMenu {
    $title = '';
    if (array_key_exists('icon', $data)) {
      $title .= $data['icon'];
    }
    $title .= " {$data['title']}";
    $submenu = new SubMenu($title);
    foreach ($data['links'] as $linkData) {
      if (is_array($linkData)) {
        $text = '';
        if (array_key_exists('icon', $linkData)) {
          $text .= $linkData['icon'];
        }
        $text .= " {$linkData['text']}";
        $submenu->appendLink($linkData['link'], $text);
      } else {
        $submenu->appendRuler();
      }
    }
    return $submenu;
  }

  public function getHtml(): string {
    return $this->menu->getHtml();
  }

}

$gen = new AccordionBuilder($footerData);
echo $gen->getHtml();

function group(array $data): \Sphp\Html\Foundation\Sites\Navigation\SubMenu {
  $title = '';
  if (array_key_exists('icon', $data)) {
    $title .= $data['icon'];
  }
  $title .= " {$data['title']}";
  $submenu = new \Sphp\Html\Foundation\Sites\Navigation\SubMenu($title);

  return $submenu;
}

foreach ($footerData['footer'] as $data) {
  echo '<pre>';
  //print_r($data);
  echo "</pre>";
  $menu->appendSubMenu(group($data));
}
//echo $menu;
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
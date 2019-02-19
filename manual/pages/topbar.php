<?php

namespace Sphp\Html\Foundation\Sites\Navigation\Bars;

use Sphp\Html\Foundation\Sites\Navigation\MenuLinkBuilder;
use Sphp\Html\Foundation\Sites\Navigation\MenuBuilder;
use Sphp\Html\Apps\Forms\SiteSearch360Form;
use Sphp\Html\Adapters\QtipAdapter;
use Sphp\Html\Foundation\Sites\Core\ThrowableCalloutBuilder;
use Sphp\Html\Foundation\Sites\Navigation\DropdownMenu;
use Sphp\Stdlib\Parsers\Parser;

$manualLinks = Parser::yaml()->readFromFile('manual/yaml/documentation_links.yaml');
$dependenciesLinks = Parser::yaml()->readFromFile('manual/yaml/dependencies_links.yml');
$externalApiLinks = Parser::yaml()->readFromFile('manual/yaml/apidocs_menu.yml');
?>
<div class="title-bar no-js" data-responsive-toggle="sphp-top-menu" data-hide-for="medium">
  <button class="menu-icon" type="button" data-toggle></button>
  <div class="title-bar-title">Menu</div>
</div>
<?php
try {
  $navi = new TopBar();
  $navi->setAttribute('id', 'sphp-top-menu');
  $navi->stackFor('medium');
  $navi->addCssClass('sphp', 'no-js');

  //$manual = (new SubMenu('Documentation'));
  $redirect = filter_input(INPUT_SERVER, 'REDIRECT_URL', FILTER_SANITIZE_URL);
  $leftDrop = new DropdownMenu();
  $builder = new MenuBuilder(new MenuLinkBuilder(trim($redirect, '/')));
  $leftDrop->appendSubMenu($builder->buildSub($manualLinks));
  $leftDrop->appendSubMenu($builder->buildSub($dependenciesLinks));
  $leftDrop->appendSubMenu($builder->buildSub($externalApiLinks));
  $navi->left()->append($leftDrop);

  $form = new SiteSearch360Form('playground.samiholck.com');
  $form->setLabelText(false);
  $form->setPlaceholder('Search Manual');

  (new QtipAdapter($form->getSubmitButton()))->setQtipPosition('bottom right', 'top center')->setViewport($navi->right());
  $navi->right()->append('<ul class="menu"><li>' . $form . '</li></ul>');

  $navi->printHtml();
} catch (\Exception $e) {
  echo ThrowableCalloutBuilder::build($e, true, true);
}

<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Html\Foundation\Sites\Bars\TopBar;
use Sphp\Html\Foundation\Sites\Navigation\MenuBuilder;
use Sphp\Html\Apps\Freefind\FreefindSearchForm;
use Sphp\Html\Adapters\QtipAdapter;

try {
  $navi = new TopBar();
  $navi->addCssClass('sphp-manual');

  //$manual = (new SubMenu('Documentation'));

  $leftDrop = new DropdownMenu();
  $builder = new MenuBuilder(new MenuLinkBuilder(trim($_SERVER["REDIRECT_URL"], '/')));
  $leftDrop->appendSubMenu($builder->buildSub($manualLinks));
  $leftDrop->appendSubMenu($builder->buildSub($dependenciesLinks));
  $leftDrop->appendSubMenu($builder->buildSub($externalApiLinks));
  $navi->left()->setContent($leftDrop);

$form = new FreefindSearchForm('r', '51613081', '&#247;', '0');
  $form->setAdditionalControls(false)->showLabel(false);
  $form->getSearchField()->setName('query')->setPlaceholder('keywords in documentation');

  (new QtipAdapter($form->getSubmitButton()))->setQtipPosition('bottom right', 'top center')->setViewport($navi->right());
  $navi->right()->setContent('<ul class="menu"><li>' . $form . '</li></ul>');

  $navi->printHtml();
} catch (\Exception $e) {
  echo new ExceptionBox($e);
}


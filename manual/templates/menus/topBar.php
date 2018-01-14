<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Html\Foundation\Sites\Bars\TopBar;
use Sphp\Html\Foundation\Sites\Navigation\MenuBuilder;
use Sphp\Html\Apps\Freefind\FreefindSearchForm;
use Sphp\Html\Adapters\QtipAdapter;
use Sphp\Html\Foundation\Sites\Containers\ThrowableCallout;

try {
  $navi = new TopBar();
  $navi->addCssClass('sphp-manual');

  //$manual = (new SubMenu('Documentation'));
  $redirect = filter_input(INPUT_SERVER, 'REDIRECT_URL', FILTER_SANITIZE_URL);
  $leftDrop = new DropdownMenu();
  $builder = new MenuBuilder(new MenuLinkBuilder(trim($redirect, '/')));
  $leftDrop->appendSubMenu($builder->buildSub($manualLinks));
  $leftDrop->appendSubMenu($builder->buildSub($dependenciesLinks));
  $leftDrop->appendSubMenu($builder->buildSub($externalApiLinks));
  $navi->left()->setContent($leftDrop);

  $form = new FreefindSearchForm(['pid' => 'r', 'si' => '51613081', 'bcd' => '&#247;', 'n' => '0']);
  $form->setLabelText(false);
  $form->setPlaceholder('keywords in documentation');

  (new QtipAdapter($form->getSubmitButton()))->setQtipPosition('bottom right', 'top center')->setViewport($navi->right());
  $navi->right()->setContent('<ul class="menu"><li>' . $form . '</li></ul>');

  $navi->printHtml();
} catch (\Exception $e) {
  echo new ThrowableCallout($e, true, true);
}


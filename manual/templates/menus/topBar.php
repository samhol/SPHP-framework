<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Html\Foundation\Sites\Bars\TopBar;
use Sphp\Html\Foundation\Sites\Navigation\MenuBuilder;
use Sphp\Html\Apps\Forms\SiteSearch360Form;
use Sphp\Html\Adapters\QtipAdapter;
use Sphp\Html\Foundation\Sites\Containers\ThrowableCallout;

try {
  $navi = new TopBar();
  $navi->stackFor('medium');
  $navi->addCssClass('sphp-manual');

  //$manual = (new SubMenu('Documentation'));
  $redirect = filter_input(INPUT_SERVER, 'REDIRECT_URL', FILTER_SANITIZE_URL);
  $leftDrop = new DropdownMenu();
  $builder = new MenuBuilder(new MenuLinkBuilder(trim($redirect, '/')));
  $leftDrop->appendSubMenu($builder->buildSub($manualLinks));
  $leftDrop->appendSubMenu($builder->buildSub($dependenciesLinks));
  $leftDrop->appendSubMenu($builder->buildSub($externalApiLinks));
  $navi->left()->setContent($leftDrop);

  $form = new SiteSearch360Form('playground.samiholck.com');
  $form->setLabelText(false);
  $form->setPlaceholder('keywords in documentation');

  (new QtipAdapter($form->getSubmitButton()))->setQtipPosition('bottom right', 'top center')->setViewport($navi->right());
  $navi->right()->setContent('<ul class="menu"><li>' . $form . '</li></ul>');

  $navi->printHtml();
} catch (\Exception $e) {
  echo new ThrowableCallout($e, true, true);
}


<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Html\Foundation\Sites\Navigation\MenuBuilder;
use Sphp\Html\Apps\Forms\SiteSearch360FormBuilder;
use Sphp\Html\Adapters\QtipAdapter;
use Sphp\Html\Foundation\Sites\Core\ThrowableCalloutBuilder;
use Sphp\Html\Media\Icons\FA;
try {

  $navi = new Bars\ResponsiveBar();
  // $navi->setAttribute('id', 'sphp-top-menu');
  //$navi->stackFor('medium');
  // $navi->addCssClass('sphp');
  //$manual = (new SubMenu('Documentation'));
  $redirect = filter_input(INPUT_SERVER, 'REDIRECT_URL', FILTER_SANITIZE_URL);
  $leftDrop = ResponsiveMenu::drilldownDropdown('medium');
  $leftDrop->setOption('autoHeight', true);
  //$leftDrop->setAttribute('data-auto-height', 'true');
  $leftDrop->appendLink('/', FA::home())->addCssClass('icon-link');
  $builder = new MenuBuilder(new MenuLinkBuilder(trim($redirect, '/')));
  $leftDrop->appendSubMenu($builder->buildSub($manualLinks));
  $leftDrop->appendSubMenu($builder->buildSub($dependenciesLinks));
  $leftDrop->appendSubMenu($builder->buildSub($externalApiLinks));
  $navi->topbar()->left()->append($leftDrop);

  $formBuilder = new SiteSearch360FormBuilder('playground.samiholck.com');
  $formBuilder->getSearchField()->setPlaceholder('Search Manual');


  $bi = new \Sphp\Html\Media\Icons\IconButtons();
  $bi->github('https://github.com/samhol/SPHP-framework', 'Gihub repository');
  $bi->facebook('https://www.facebook.com/Sami.Petteri.Holck.Playground/', 'Facebook page');
  // $bi->googlePlus('https://plus.google.com/b/113942361282002156141/113942361282002156141', 'Google plus page');
  $bi->twitter('https://twitter.com/SPHPframework', 'Twitter page');
  $bi->addCssClass('smooth');

  $navi->titleBar()->right()->append($bi);
  (new QtipAdapter($formBuilder->getSubmitButton()))->setQtipPosition('bottom right', 'top center')->setViewport($navi->topbar()->right());
  $navi->topbar()->right()->append($formBuilder->buildMenuForm());

  $navi->printHtml();
} catch (\Exception $e) {
  echo ThrowableCalloutBuilder::build($e, true, true);
}

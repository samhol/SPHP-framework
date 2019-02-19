<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Html\Foundation\Sites\Bars\TopBar;
use Sphp\Html\Foundation\Sites\Navigation\MenuBuilder;
use Sphp\Html\Apps\Forms\SiteSearch360Form;
use Sphp\Html\Adapters\QtipAdapter;
use Sphp\Html\Foundation\Sites\Core\ThrowableCalloutBuilder;

?>
<div class="sphp responsive-bar-container no-js">
  <div class="title-bar" data-responsive-toggle="sphp-top-menu" data-hide-for="medium">
    <button class="menu-icon" type="button" data-toggle></button>
    <div class="title-bar-title">SPHPlayground Menu</div>
  </div>
  <?php
  try {
    
    $navi = new Bars\ResponsiveBar();
   // $navi->setAttribute('id', 'sphp-top-menu');
    //$navi->stackFor('medium');
   // $navi->addCssClass('sphp');

    //$manual = (new SubMenu('Documentation'));
    $redirect = filter_input(INPUT_SERVER, 'REDIRECT_URL', FILTER_SANITIZE_URL);
    $leftDrop = new DropdownMenu();
    $builder = new MenuBuilder(new MenuLinkBuilder(trim($redirect, '/')));
    $leftDrop->appendSubMenu($builder->buildSub($manualLinks));
    $leftDrop->appendSubMenu($builder->buildSub($dependenciesLinks));
    $leftDrop->appendSubMenu($builder->buildSub($externalApiLinks));
    $navi->topbar()->left()->append($leftDrop);

    $form = new SiteSearch360Form('playground.samiholck.com');
    $form->setLabelText(false);
    $form->setPlaceholder('Search Manual');

    (new QtipAdapter($form->getSubmitButton()))->setQtipPosition('bottom right', 'top center')->setViewport($navi->topbar()->right());
    $navi->topbar()->right()->append('<ul class="menu"><li>' . $form . '</li></ul>');

    $navi->printHtml();
  } catch (\Exception $e) {
    echo ThrowableCalloutBuilder::build($e, true, true);
  }
  ?>
</div>
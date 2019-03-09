<?php


namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Html\Foundation\Sites\Navigation\MenuBuilder;
use Sphp\Html\Apps\Forms\SiteSearch360FormBuilder;
use Sphp\Html\Adapters\QtipAdapter;
use Sphp\Html\Foundation\Sites\Core\ThrowableCalloutBuilder;

try {

  $navi = new Bars\ResponsiveBar();
  $redirect = filter_input(INPUT_SERVER, 'REDIRECT_URL', FILTER_SANITIZE_URL);
  $leftDrop = new FlexibleMenu();
  $leftDrop->attributes();
  $leftDrop->addCssClass('vertical medium-horizontal menu');
  $leftDrop->setAttribute('data-responsive-menu','drilldown medium-dropdown');
  $leftDrop->appendSubMenu()->setVertical(true)->setRoot('Foo')->appendLink('#foobar','FooBar');
  $leftDrop->appendSubMenu()->setVertical(true)->setRoot('Bar')->appendLink('#foobar','FooBar');
  $leftDrop->appendSubMenu()->setVertical(true)->setRoot('Baz')->appendLink('#foobar','FooBar');
  $navi->topbar()->left()->append($leftDrop);

  $form = new SiteSearch360FormBuilder('playground.samiholck.com');
  $form->getSearchField()->setPlaceholder('Search Manual');

  //(new QtipAdapter($form->getSubmitButton()))->setQtipPosition('bottom right', 'top center')->setViewport($navi->topbar()->right());
  $navi->topbar()->right()->append($form->buildMenuForm());

  $navi->printHtml();
} catch (\Exception $e) {
  echo ThrowableCalloutBuilder::build($e, true, true);
}

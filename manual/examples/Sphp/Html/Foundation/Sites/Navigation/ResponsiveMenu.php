<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Stdlib\Parsers\Parser;
use Sphp\Html\Media\Icons\FA;
$menu = new ResponsiveMenu();
$menu->setDefaultrOrientation(Menu::VERTICAL)->setOrientationFor('medium', Menu::HORIZONTAL);
$menu->setDefaultType(Menu::DRILLDOWN, 'medium', Menu::DROPDOWN);
//$menu->setVertical()->setAttribute('data-responsive-menu','drilldown medium-accordion');
$menu->appendLink('/', 'foo');
$menu->appendLink('/', 'foo');
$menu->appendLink('/', 'foo');
$submenu = $menu->appendSubMenu()->setRoot('Item 3');
$submenu->appendLink("#Item3.1", "Item 3.1", "_self");
$submenu->appendLink("#Item3.2", "Item 3.2", "_self");
$submenu->appendLink("#Item3.3", "Item 3.3", "_self");
$submenu->appendLink("#Item3.4", "Item 3.4", "_self");
//echo $menu;

$manualLinks = Parser::yaml()->readFromFile('/home/int48291/public_html/playground/manual/yaml/documentation_links.yaml');
$m = new ResponsiveMenu();
$m->appendLink('/', FA::home())->addCssClass('icon-link');
$m->setDefaultrOrientation(Menu::VERTICAL)->setOrientationFor('medium', Menu::HORIZONTAL);
$m->setDefaultType(Menu::DRILLDOWN, 'medium', Menu::DROPDOWN);
$menuBuilder = new MenuBuilder();
$m->appendSubMenu($menuBuilder->buildSub($manualLinks));
echo $m;

<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

$menu = FlexibleMenu::createDropdown()->addCssClass('sphp');

$submenu = $menu->appendSubMenu();
$submenu->setRoot('Sub');
$submenu1 = $submenu->append(new SubMenu('foo'));
$submenu->appendRuler();
$submenu->appendLink("#sub1", "Sub Item 1", "_self");
$submenu1->appendLink("#sub2", "Sub Item 2", "_self");
$submenu->appendText('More...');
$submenu->appendLink("#sub3", "Sub Item 3", "_self");
$submenu1->appendLink("#sub4", "Sub Item 4", "_self");
$menu->appendLink("#Root2", "Item 1", "_self");
$menu->appendLink("#Root3", "Item 2", "_self");
$menu->printHtml();

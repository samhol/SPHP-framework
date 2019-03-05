<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

$drilldownMenu = FlexibleMenu::createDrilldown();

$drilldownMenu->appendLink("#Item1", "Item 1", "_self");
$drilldownMenu->appendLink("#Item2", "Item 2", "_self");
$submenu = $drilldownMenu->appendSubMenu()->setRoot('Item 3');
$submenu->appendLink("#Item3.1", "Item 3.1", "_self");
$submenu->appendLink("#Item3.2", "Item 3.2", "_self");
$submenu->appendLink("#Item3.3", "Item 3.3", "_self");
$submenu->appendLink("#Item3.4", "Item 3.4", "_self");
$drilldownMenu->printHtml();

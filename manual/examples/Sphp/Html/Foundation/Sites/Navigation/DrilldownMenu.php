<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

$drilldownMenu = (new DrilldownMenu());

$drilldownMenu->appendSubMenu()
        ->setRoot("Item 3")
        ->appendLink("#Item 3.1", "Item 3.1", "_self")
        ->appendLink("#Item 3.2", "Item 3.2", "_self")
        ->appendLink("#Item 3.3", "Item 3.3", "_self")
        ->appendLink("#Item 3.4", "Item 3.4", "_self");
$drilldownMenu->appendLink("#Item 1", "Item 1", "_self")
        ->appendLink("#Item 2", "Item 2", "_self");
$drilldownMenu->printHtml();

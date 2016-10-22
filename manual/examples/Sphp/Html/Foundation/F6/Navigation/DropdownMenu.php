<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

$menu = (new DropdownMenu());

$menu->appendSubMenu()
        ->setRoot("Root1")
        ->appendLink("#sub1", "Sub Item 1", "_self")
        ->appendLink("#sub2", "Sub Item 2", "_self")
        ->appendLink("#sub3", "Sub Item 3", "_self")
        ->appendLink("#sub4", "Sub Item 4", "_self");
$menu->appendLink("#Root2", "Item 1", "_self")
        ->appendLink("#Root3", "Item 2", "_self");
$menu->printHtml();

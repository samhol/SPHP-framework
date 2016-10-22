<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Html\Foundation\Sites\Containers\Accordions\SyntaxHighlightingSingleAccordion;
use Sphp\Html\Navigation\HyperlinkInterface;

$hyperlinkIfLink = $api->classLinker(HyperlinkInterface::class);
$menuInterface = $api->classLinker(MenuInterface::class);
$drilldownMenu = $api->classLinker(DrilldownMenu::class);
$dropdownMenu = $api->classLinker(DropdownMenu::class);
$accordionMenu = $api->classLinker(AccordionMenu::class);
echo $parsedown->text(<<<MD
##Navigation menus implementing $menuInterface

The $drilldownMenu component is one of Foundation's three menu patterns, which converts a series of nested lists into a vertical drilldown menu.

* $dropdownMenu is an expandable dropdown menu
* $accordionMenu is an expandable accordion menu
* $drilldownMenu is a vertical drilldown menu
MD
);

use Sphp\Html\Foundation\Sites\Grids\BlockGrid as BlockGrid;

$navExamples = (new BlockGrid())
        ->setBlockGrids(1, 2, 3)
        ->setStyle("margin-bottom", ".3em")
        ->appendPhpFile(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Navigation/DropdownMenu.php')
        ->appendPhpFile(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Navigation/AccordionMenu.php')
        ->appendPhpFile(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Navigation/DrilldownMenu.php')
        ->printHtml();

SyntaxHighlightingSingleAccordion::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Navigation/DrilldownMenu.php');

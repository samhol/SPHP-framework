<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Html\Foundation\Sites\Containers\Accordions\SyntaxHighlightingSingleAccordion;
use Sphp\Html\Navigation\HyperlinkInterface;
use Sphp\Html\Apps\Manual\Apis;

$hyperlinkIfLink = Apis::apigen()->classLinker(HyperlinkInterface::class);
$menuInterface = Apis::apigen()->classLinker(MenuInterface::class);
$drilldownMenu = Apis::apigen()->classLinker(DrilldownMenu::class);
$dropdownMenu = Apis::apigen()->classLinker(DropdownMenu::class);
$accordionMenu = Apis::apigen()->classLinker(AccordionMenu::class);
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
        ->appendPhpFile('Sphp/Html/Foundation/Sites/Navigation/DropdownMenu.php')
        ->appendPhpFile('Sphp/Html/Foundation/Sites/Navigation/AccordionMenu.php')
        ->appendPhpFile('Sphp/Html/Foundation/Sites/Navigation/DrilldownMenu.php')
        ->printHtml();

SyntaxHighlightingSingleAccordion::visualize('Sphp/Html/Foundation/Sites/Navigation/DrilldownMenu.php');

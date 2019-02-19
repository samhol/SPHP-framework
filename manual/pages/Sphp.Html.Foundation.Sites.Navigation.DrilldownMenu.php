<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Html\Navigation\HyperlinkInterface;

$hyperlinkIfLink = \Sphp\Manual\api()->classLinker(HyperlinkInterface::class);
$menuInterface = \Sphp\Manual\api()->classLinker(Menu::class);
$drilldownMenu = \Sphp\Manual\api()->classLinker(DrilldownMenu::class);
$dropdownMenu = \Sphp\Manual\api()->classLinker(DropdownMenu::class);
$accordionMenu = \Sphp\Manual\api()->classLinker(AccordionMenu::class);
\Sphp\Manual\md(<<<MD
##Navigation menus implementing $menuInterface

The $drilldownMenu component is one of Foundation's three menu patterns, which converts a series of nested lists into a vertical drilldown menu.

* $dropdownMenu is an expandable dropdown menu
* $accordionMenu is an expandable accordion menu
* $drilldownMenu is a vertical drilldown menu
MD
);

use Sphp\Html\Foundation\Sites\Grids\BlockGrid;

$navExamples = new BlockGrid('small-up-1', 'medium-up-2', 'large-up-3');
        $navExamples->appendPhpFile('Sphp/Html/Foundation/Sites/Navigation/DropdownMenu.php')->addCssClass('example');
        $navExamples->appendPhpFile('Sphp/Html/Foundation/Sites/Navigation/AccordionMenu.php')->addCssClass('example');
        $navExamples->appendPhpFile('Sphp/Html/Foundation/Sites/Navigation/DrilldownMenu.php')->addCssClass('example');
        $navExamples->printHtml();

\Sphp\Manual\visualize('Sphp/Html/Foundation/Sites/Navigation/DrilldownMenu.php');

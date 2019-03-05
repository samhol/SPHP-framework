<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Html\Navigation\HyperlinkInterface;
$w3c = \Sphp\Manual\w3schools();
$hyperlinkIfLink = \Sphp\Manual\api()->classLinker(HyperlinkInterface::class);
$menu = \Sphp\Manual\api()->classLinker(Menu::class);
$flexibleMenu = \Sphp\Manual\api()->classLinker(FlexibleMenu::class);
$drilldownMenu = \Sphp\Manual\api()->classLinker(FlexibleMenu::class)->createDrilldown;
$dropdownMenu = \Sphp\Manual\api()->classLinker(FlexibleMenu::class)->createDropdown;
$accordionMenu = \Sphp\Manual\api()->classLinker(FlexibleMenu::class)->createAccordion;
\Sphp\Manual\md(<<<MD
## Menus implementing $menu interface

Foundation based menus are flexible, all-purpose components for responsive navigation. 
All implementations of a $menu interface are comprised of $w3c->ul HTML tags 
filled with $w3c->li tags containing links and test. By default, Menus are horizontally oriented.


### The $flexibleMenu class
        
$flexibleMenu implements three Foundation navigation menu patterns. These menu 
patterns are created by using following static methods
        
* $dropdownMenu generates an expandable dropdown menu
* $accordionMenu generates an expandable accordion menu
* $drilldownMenu generates a vertical drilldown menu.
MD
);

use Sphp\Html\Foundation\Sites\Grids\BlockGrid;

$navExamples = new BlockGrid('small-up-1', 'medium-up-2', 'large-up-3');
$navExamples->addCssClass('grid-margin-x');
$navExamples->setAttribute('data-equalizer','foo');
$navExamples->appendPhpFile('Sphp/Html/Foundation/Sites/Navigation/DropdownMenu.php')
        ->addCssClass('example')->setAttribute('data-equalizer-watch','foo');
$navExamples->appendPhpFile('Sphp/Html/Foundation/Sites/Navigation/AccordionMenu.php')
        ->addCssClass('example')->setAttribute('data-equalizer-watch','foo');
$navExamples->appendPhpFile('Sphp/Html/Foundation/Sites/Navigation/DrilldownMenu.php')
        ->addCssClass('example')->setAttribute('data-equalizer-watch','foo');
$navExamples->printHtml();


\Sphp\Manual\md(<<<MD
## The $flexibleMenu component

The $flexibleMenu component provides navigation for the entire site, or for sections of an individual page.

**Accessibility:** Using the `Tab` button, a user can navigate until
they've reached the link below. (`Shift+Tab` to navigate back one step.)
MD
);

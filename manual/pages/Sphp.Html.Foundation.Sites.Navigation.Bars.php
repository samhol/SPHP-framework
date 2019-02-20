<?php

namespace Sphp\Html\Foundation\Sites\Navigation\Bars;

use Sphp\Html\Foundation\Sites\Navigation\Menu;
use Sphp\Html\Foundation\Sites\Navigation\DropdownMenu;
$abstractBar = \Sphp\Manual\api()->classLinker(AbstractBar::class);
$left = $abstractBar->methodLink('left',false);
$right = $abstractBar->methodLink('right',false);
$titleBar = \Sphp\Manual\api()->classLinker(TitleBar::class);
$topBar = \Sphp\Manual\api()->classLinker(TopBar::class);
$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$menuInterface = \Sphp\Manual\api()->classLinker(Menu::class);
$dropdownMenu = \Sphp\Manual\api()->classLinker(DropdownMenu::class);
$navigationNs = $menuInterface->namespaceLink(false);
\Sphp\Manual\md(<<<MD
## Foundation bars: <small>simple wrappers around flexible menu components</small>

$ns

This namespace contains classes and interfaces for Foundation navigation bars.
Navigation bars can be used with menus implemented in $navigationNs namespace components. 

A bar component has a left-hand section $left and a right-hand section $right. 
  On small screens, these sections stack on top of each other.
        
* Title Bar: <small>The $titleBar component</small>
* Top Bar: <small>The $topBar component</small>
        
MD
);
\Sphp\Manual\visualize('Sphp/Html/Foundation/Sites/Navigation/Bars/ResponsiveBar.php');


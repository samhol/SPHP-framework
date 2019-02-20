<?php

namespace Sphp\Html\Foundation\Sites\Navigation\Bars;

use Sphp\Html\Foundation\Sites\Navigation\Menu;
use Sphp\Html\Foundation\Sites\Navigation\DropdownMenu;

$titleBar = \Sphp\Manual\api()->classLinker(TitleBar::class);
$topBar = \Sphp\Manual\api()->classLinker(TopBar::class);
$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$menuInterface = \Sphp\Manual\api()->classLinker(Menu::class);
$dropdownMenu = \Sphp\Manual\api()->classLinker(DropdownMenu::class);
$navigationNs = $menuInterface->namespaceLink(false);
\Sphp\Manual\md(<<<MD
#Foundation bars: <small>wrappers around flexible navigation components</small>
$ns
This namespace contains classes and interfaces for Foundation navigation bars.
These navigation bars can be used with menus implemented in $navigationNs namespace; especially $dropdownMenu components. 

##Foundation Title Bar: <small>The $titleBar component</small>

MD
);
\Sphp\Manual\md(<<<MD
##Foundation Top Bar: <small>The $topBar component</small>
        
Top Bar component is a simple wrapper around menu components.
MD
);
\Sphp\Manual\visualize('Sphp/Html/Foundation/Sites/Navigation/Bars/ResponsiveBar.php');


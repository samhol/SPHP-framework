<?php

namespace Sphp\Html\Foundation\Sites\Bars;

use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;
use Sphp\Html\Apps\Manual\Apis;

$titleBar = Apis::apigen()->classLinker(TitleBar::class);
$topBar = Apis::apigen()->classLinker(TopBar::class);
$ns = Apis::apigen()->namespaceBreadGrumbs(__NAMESPACE__);
$menuInterface = Apis::apigen()->classLinker(\Sphp\Html\Foundation\Sites\Navigation\MenuInterface::class);
$dropdownMenu = Apis::apigen()->classLinker(\Sphp\Html\Foundation\Sites\Navigation\DropdownMenu::class);
$navigationNs = $menuInterface->namespaceLink(false);
echo $parsedown->text(<<<MD
#Foundation bars: <small>wrappers around flexible navigation components</small>
$ns
This namespace contains classes and interfaces for Foundation navigation bars.
These navigation bars can be used with menus implemented in $navigationNs namespace; especially $dropdownMenu components. 

##Foundation Title Bar: <small>The $titleBar component</small>

MD
);


CodeExampleAccordion::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Containers/TitleBar.php');
echo $parsedown->text(<<<MD
##Foundation Top Bar: <small>The $topBar component</small>
        
Top Bar component is a simple wrapper around menu components.
MD
);

CodeExampleAccordion::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Buttons/SplitButton.php');

<?php

namespace Sphp\Html\Foundation\Sites\Bars;

use Sphp\Html\Foundation\Sites\Navigation\MenuInterface;
use Sphp\Html\Foundation\Sites\Navigation\DropdownMenu;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$titleBar = Apis::apigen()->classLinker(TitleBar::class);
$topBar = Apis::apigen()->classLinker(TopBar::class);
$ns = Apis::apigen()->namespaceBreadGrumbs(__NAMESPACE__);
$menuInterface = Apis::apigen()->classLinker(MenuInterface::class);
$dropdownMenu = Apis::apigen()->classLinker(DropdownMenu::class);
$navigationNs = $menuInterface->namespaceLink(false);
echo $parsedown->text(<<<MD
#Foundation bars: <small>wrappers around flexible navigation components</small>
$ns
This namespace contains classes and interfaces for Foundation navigation bars.
These navigation bars can be used with menus implemented in $navigationNs namespace; especially $dropdownMenu components. 

##Foundation Title Bar: <small>The $titleBar component</small>

MD
);


CodeExampleBuilder::visualize('Sphp/Html/Foundation/Sites/Containers/TitleBar.php');
echo $parsedown->text(<<<MD
##Foundation Top Bar: <small>The $topBar component</small>
        
Top Bar component is a simple wrapper around menu components.
MD
);

CodeExampleBuilder::visualize('Sphp/Html/Foundation/Sites/Buttons/SplitButton.php');

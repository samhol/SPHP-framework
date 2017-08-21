<?php

namespace Sphp\Html\Foundation\Sites\Bars;

use Sphp\Html\Foundation\Sites\Navigation\MenuInterface;
use Sphp\Html\Foundation\Sites\Navigation\DropdownMenu;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$titleBar = Apis::sami()->classLinker(TitleBar::class);
$topBar = Apis::sami()->classLinker(TopBar::class);
$ns = Apis::sami()->namespaceBreadGrumbs(__NAMESPACE__);
$menuInterface = Apis::sami()->classLinker(MenuInterface::class);
$dropdownMenu = Apis::sami()->classLinker(DropdownMenu::class);
$navigationNs = $menuInterface->namespaceLink(false);
\Sphp\Manual\parseDown(<<<MD
#Foundation bars: <small>wrappers around flexible navigation components</small>
$ns
This namespace contains classes and interfaces for Foundation navigation bars.
These navigation bars can be used with menus implemented in $navigationNs namespace; especially $dropdownMenu components. 

##Foundation Title Bar: <small>The $titleBar component</small>

MD
);


CodeExampleBuilder::visualize('Sphp/Html/Foundation/Sites/Containers/TitleBar.php');
\Sphp\Manual\parseDown(<<<MD
##Foundation Top Bar: <small>The $topBar component</small>
        
Top Bar component is a simple wrapper around menu components.
MD
);

CodeExampleBuilder::visualize('Sphp/Html/Foundation/Sites/Buttons/SplitButton.php');

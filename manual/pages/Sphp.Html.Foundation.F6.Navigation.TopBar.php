<?php

namespace Sphp\Html\Foundation\F6\Navigation\TopBar;

use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;

$namespace = $api->getNamespaceLink(__NAMESPACE__);
$topBar = $api->getClassLink(TopBar::class);
echo $parsedown->text(<<<MD
##The $topBar component

The $topBar displays a complex navigation bar on small, medium or large screens.

Positioning The $topBar component: The $topBar component will take on full-browser width by default. To make the
component stay fixed as when scroll, call method {$api->getClassMethodLink(TopBar::class, "setFixed")}.
To make the navigation to be set to the grid width, call method {$api->getClassMethodLink(TopBar::class, "useGridWidth")}.
		
Below is an example of $topBar object similar to the one seen on top of each pages of this manual.

MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Navigation/TopBar.php');

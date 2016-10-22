<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;
use Sphp\Html\Apps\Manual\Apis;

$topBar = Apis::apigen()->classLinker(TopBar::class);
$left = $topBar->method("left");
$right = $topBar->method("right");
//$namespace = $api->namespaceLink(__NAMESPACE__);
//$topBar = $api->classLinker(TopBar::class);
echo $parsedown->text(<<<MD
##The $topBar component

A $topBar component can have two sections: a left-hand section $left and a right-hand section $right. 
  On small screens, these sections stack on top of each other.
		
Below is an example of $topBar object similar to the one seen on top of each pages of this manual.

MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Navigation/TopBar.php');

<?php

namespace Sphp\Html\Foundation\Bars;

$topBar = \Sphp\Manual\api()->classLinker(TopBar::class);
$left = $topBar->methodLink("left");
$right = $topBar->methodLink("right");
//$namespace = $api->namespaceLink(__NAMESPACE__);
//$topBar = $api->classLinker(TopBar::class);
\Sphp\Manual\md(<<<MD
##The $topBar component

A $topBar component can have two sections: a left-hand section $left and a right-hand section $right. 
  On small screens, these sections stack on top of each other.
		
Below is an example of $topBar object similar to the one seen on top of each pages of this manual.

MD
);
\Sphp\Manual\visualize('Sphp/Html/Foundation/Sites/Bars/TopBar.php');

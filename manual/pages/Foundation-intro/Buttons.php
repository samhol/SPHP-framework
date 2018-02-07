<?php

namespace Sphp\Html\Foundation\Sites\Buttons;

$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

echo <<<MD
##Foundation 6 Buttons and Button containers
$ns
This namespace includes Foundation 6 styled buttons for many purposes. Because buttons 
are a core interactive element, it's important to use the right one for each occasion.
A basic Foundation styled button can be based on almost any HTML tag that has one CSS-class.
        
###Navigation component examples:

MD
;

use Sphp\Html\Foundation\Sites\Grids\BlockGrid;

$blockGrid = new BlockGrid();

$blockGrid->appendPhpFile('Sphp/Html/Foundation/Sites/Buttons/ButtonGroup-setColor.php');
$blockGrid->appendPhpFile('Sphp/Html/Foundation/Sites/Buttons/ButtonGroup-stackFor.php')
        ->printHtml();




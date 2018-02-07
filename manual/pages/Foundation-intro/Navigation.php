<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

$toolsLink = \Sphp\Manual\api()->namespaceLink(__NAMESPACE__, false);

$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

echo <<<MD
##Foundation 6 Navigation components:
        
$ns

This namespace includes many Foundation 6 navigation patterns implemented in object oriented PHP.
These navigation components can be combined to form more complex, robust responsive navigation 
solutions. For example this namespace contains a complex top bar that supports dropdown navigation, 
sidebars and many other menu structures.
        
###Navigation component examples:
<div class="example-area">
MD
;

include('Sphp/Html/Foundation/Sites/Navigation/DropdownMenu.php');
echo "</div>";

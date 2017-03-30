<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Html\Apps\Manual\Apis;

$toolsLink = Apis::apigen()->namespaceLink(__NAMESPACE__, false);

$ns = Apis::apigen()->namespaceBreadGrumbs(__NAMESPACE__);

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

include('Sphp/Html/Foundation/F6/Navigation/DropdownMenu.php');
echo "</div>";

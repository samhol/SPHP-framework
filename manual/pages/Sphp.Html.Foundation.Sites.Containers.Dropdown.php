<?php

namespace Sphp\Html\Foundation\Sites\Containers;

use Sphp\Manual;

$ns = Manual\api()->namespaceLink(__NAMESPACE__);
$dropdown = Manual\api()->classLinker(Dropdown::class);

Manual\md(<<<MD
###The $dropdown component
		
The $dropdown component can be used to attach dropdowns or popovers to whatever Component needed.
MD
);
Manual\visualize('Sphp/Html/Foundation/Sites/Containers/Dropdown.php');

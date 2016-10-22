<?php

namespace Sphp\Html\Foundation\Sites\Containers;
use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;

$ns = $api->namespaceLink(__NAMESPACE__);
$dropdown = $api->classLinker(Dropdown::class);

echo $parsedown->text(<<<MD
###The $dropdown component
		
The $dropdown component can be used to attach dropdowns or popovers to whatever Component needed.
MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Containers/Dropdown.php');

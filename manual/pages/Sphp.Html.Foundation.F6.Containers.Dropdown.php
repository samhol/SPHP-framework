<?php

namespace Sphp\Html\Foundation\F6\Containers;
use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;

$ns = $api->getNamespaceLink(__NAMESPACE__);
$dropdown = $api->getClassLink(Dropdown::class);

echo $parsedown->text(<<<MD
###The $dropdown component
		
The $dropdown component can be used to attach dropdowns or popovers to whatever Component needed.
MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Containers/Dropdown.php');

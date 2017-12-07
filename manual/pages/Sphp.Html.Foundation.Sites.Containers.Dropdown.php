<?php

namespace Sphp\Html\Foundation\Sites\Containers;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleAccordionBuilder;
use Sphp\Html\Apps\Manual\Apis;

$ns = \Sphp\Manual\api()->namespaceLink(__NAMESPACE__);
$dropdown = \Sphp\Manual\api()->classLinker(Dropdown::class);

\Sphp\Manual\md(<<<MD
###The $dropdown component
		
The $dropdown component can be used to attach dropdowns or popovers to whatever Component needed.
MD
);
CodeExampleAccordionBuilder::visualize('Sphp/Html/Foundation/Sites/Containers/Dropdown.php');

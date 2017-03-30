<?php

namespace Sphp\Html\Foundation\Sites\Containers;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$ns = Apis::apigen()->namespaceLink(__NAMESPACE__);
$dropdown = $api->classLinker(Dropdown::class);

echo $parsedown->text(<<<MD
###The $dropdown component
		
The $dropdown component can be used to attach dropdowns or popovers to whatever Component needed.
MD
);
CodeExampleBuilder::visualize('Sphp/Html/Foundation/F6/Containers/Dropdown.php');

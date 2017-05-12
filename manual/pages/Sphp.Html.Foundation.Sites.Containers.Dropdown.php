<?php

namespace Sphp\Html\Foundation\Sites\Containers;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$ns = Apis::sami()->namespaceLink(__NAMESPACE__);
$dropdown = Apis::sami()->classLinker(Dropdown::class);

echo $parsedown->text(<<<MD
###The $dropdown component
		
The $dropdown component can be used to attach dropdowns or popovers to whatever Component needed.
MD
);
CodeExampleBuilder::visualize('Sphp/Html/Foundation/Sites/Containers/Dropdown.php');

<?php

namespace Sphp\Html\Forms\Inputs\Menus;

use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;

$selectLink = $api->classLinker(Select::class);
$option = $api->classLinker(Option::class);
$optGroup = $api->classLinker(Optgroup::class);
echo $parsedown->text(<<<MD
###The $selectLink component
	
The $selectLink component is used to create a drop-down list in forms. The $option 
components inside a $selectLink component define the available options in the list 
$option components can be grouped using $optGroup components,

MD
);
(new CodeExampleAccordion(EXAMPLE_DIR . 'Sphp/Html/Forms/Menus/Select.php'))
        ->addCssClass("form-example")
        ->printHtml();

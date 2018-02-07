<?php

namespace Sphp\Html\Forms\Inputs\Menus;

use Sphp\Manual;

$selectLink = Manual\api()->classLinker(Select::class);
$option = Manual\api()->classLinker(Option::class);
$optGroup = Manual\api()->classLinker(Optgroup::class);
Manual\md(<<<MD
###The $selectLink component
	
The $selectLink component is used to create a drop-down list in forms. The $option 
components inside a $selectLink component define the available options in the list 
$option components can be grouped using $optGroup components,

MD
);
Manual\example('Sphp/Html/Forms/Menus/Select.php')
        ->buildAccordion()
        ->addCssClass("form-example")
        ->printHtml();

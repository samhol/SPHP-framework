<?php

namespace Sphp\Html\Forms\Inputs\Menus;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$selectLink = \Sphp\Manual\api()->classLinker(Select::class);
$option = \Sphp\Manual\api()->classLinker(Option::class);
$optGroup = \Sphp\Manual\api()->classLinker(Optgroup::class);
\Sphp\Manual\parseDown(<<<MD
###The $selectLink component
	
The $selectLink component is used to create a drop-down list in forms. The $option 
components inside a $selectLink component define the available options in the list 
$option components can be grouped using $optGroup components,

MD
);
(new CodeExampleBuilder('Sphp/Html/Forms/Menus/Select.php'))
        ->buildAccordion()
        ->addCssClass("form-example")
        ->printHtml();

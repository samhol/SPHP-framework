<?php

namespace Sphp\Html\Forms;

use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;

$ionRangeSlider = $api->getClassLink(IonRangeSlider::class);
echo $parsedown->text(<<<MD
###The $ionRangeSlider component
		
The $ionRangeSlider component implements a Ion.RangeSlider. The original Ion.RangeSlider 
is a jQuery range slider with CSS3 skin support.
MD
);
//include EXAMPLE_DIR . 'Sphp/Html/Forms/IonRangeSlider.php';
//$exampleViewer(EXAMPLE_DIR . 'Sphp/Html/Forms/IonRangeSlider.php', false, true);


(new CodeExampleAccordion(EXAMPLE_DIR . 'Sphp/Html/Forms/IonRangeSlider.php', false, true))
        ->addCssClass("form-example")
        ->printHtml();
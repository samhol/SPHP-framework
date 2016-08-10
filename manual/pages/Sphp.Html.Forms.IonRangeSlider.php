<?php

namespace Sphp\Html\Forms\Inputs\Ion;

use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;
use Sphp\Html\Apps\Manual\Apis as Apis;
$slider = $api->getClassLink(Slider::class);
$rangeSlider = $api->getClassLink(RangeSlider::class);
$nsLink = Apis::apigen()->namespaceLink(__NAMESPACE__, false);
$ns = $api->getNamespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD
##The $nsLink namespace containing $slider and $rangeSlider component
		
These components implement [Ion.RangeSlider](http://ionden.com/a/plugins/ion.rangeSlider/en.html){target="_blank"} 
client side slider element for object oriented PHP. The original Ion.RangeSlider 
is a jQuery range slider with CSS3 skin support.
        
        
 
###The $slider component for single sliders
MD
);

(new CodeExampleAccordion(EXAMPLE_DIR . 'Sphp/Html/Forms/Ion/Slider.php', false, true))
        ->addCssClass("form-example")
        ->printHtml();
echo $parsedown->text(<<<MD
##The $rangeSlider component for double (range) sliders
		
MD
);
(new CodeExampleAccordion(EXAMPLE_DIR . 'Sphp/Html/Forms/Ion/RangeSlider.php', false, true))
        ->addCssClass("form-example")
        ->printHtml();

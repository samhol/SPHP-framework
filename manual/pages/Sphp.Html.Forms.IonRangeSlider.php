<?php

namespace Sphp\Html\Forms\Inputs\Ion;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$slider = \Sphp\Manual\api()->classLinker(Slider::class);
$rangeSlider = \Sphp\Manual\api()->classLinker(RangeSlider::class);
$nsLink = \Sphp\Manual\api()->namespaceLink(__NAMESPACE__, false);
$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
\Sphp\Manual\parseDown(<<<MD
##The $nsLink namespace containing $slider and $rangeSlider component

These components implement [Ion.RangeSlider](http://ionden.com/a/plugins/ion.rangeSlider/en.html){target="_blank"} 
client side slider element for object oriented PHP. The original Ion.RangeSlider 
is a jQuery range slider with CSS3 skin support.

###The $slider component for single sliders
MD
);

(new CodeExampleBuilder('Sphp/Html/Forms/Ion/Slider.php', false, true))
        ->buildAccordion()
        ->addCssClass("form-example")
        ->printHtml();
\Sphp\Manual\parseDown(<<<MD
##The $rangeSlider component for double (range) sliders
		
MD
);
(new CodeExampleBuilder('Sphp/Html/Forms/Ion/RangeSlider.php', false, true))
        ->buildAccordion()
        ->addCssClass("form-example")
        ->printHtml();

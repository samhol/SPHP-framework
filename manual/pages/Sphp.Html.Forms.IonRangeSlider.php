<?php

namespace Sphp\Html\Forms\Inputs\Ion;

use Sphp\Manual;
use Sphp\Html\Forms\Inputs\RangeInput;
$rangeInput = Manual\api()->classLinker(RangeInput::class);
$slider = Manual\api()->classLinker(Slider::class);
$rangeSlider = Manual\api()->classLinker(RangeSlider::class);
$nsLink = Manual\api()->namespaceLink(__NAMESPACE__, false);
$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

Manual\md(<<<MD
##Sliders and range sliders <small markdown="1">implemntations of $rangeInput interface</small>
$ns
        
All sliders in this namespace implement $rangeInput interface. These components specify numeric values which must be no less than a 
given value, and no more than another given value. 

A $slider object implements single sliders, whereas $rangeSlider component implements double (range) sliders.
        
These components implement [Ion.RangeSlider](http://ionden.com/a/plugins/ion.rangeSlider/en.html){target="_blank"} 
client side slider element for object oriented PHP. The original Ion.RangeSlider 
is a jQuery range slider with CSS3 skin support.
        
MD
);

Manual\example('Sphp/Html/Forms/Ion/Slider.php', null, true)
        ->buildAccordion()
        ->addCssClass('form-example')
        ->printHtml();

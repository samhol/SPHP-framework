<?php

namespace Sphp\Html\Foundation\F6\Forms\Inputs;

use Sphp\Html\Forms\Inputs\SliderInterface as SliderInterface;
use Sphp\Html\Foundation\F6\Containers\Accordions\SyntaxHighlightingSingleAccordion;

$slider = $api->classLinker(Slider::class);
$rangeSlider = $api->classLinker(RangeSlider::class);
$sliderInterface = $api->classLinker(SliderInterface::class);


echo $parsedown->text(<<<MD
##$slider and $rangeSlider components

These components implement $sliderInterface and Foundation frameworks Sliders on clientside

####IMPORTANT:
When placing a $slider or a $rangeSlider object into a dropdown component, the slider will have correct initial positioning but
will jump to one end on the first slide. The initial positioning is calculated when the slider is added to the DOM (which when inside
a dropdown is far off screen), and not when it is first made visible.

The example code of the form showing the exaples of $slider object is represented below.
MD
);
include_once (EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Forms/sliders.php');
SyntaxHighlightingSingleAccordion::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Forms/sliders.php');
echo $parsedown->text(<<<MD

MD
);

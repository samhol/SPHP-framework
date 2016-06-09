<?php

namespace Sphp\Html\Foundation\F6\Forms;

$rangeSlider = $api->getClassLink(Slider::class);

use Sphp\Html\Apps\SingleAccordion as SingleAccordion;

echo $parsedown->text(<<<MD
##The Foundation $rangeSlider component

The $rangeSlider is directly ported from the Foundation front-end framework to the SPHP framework.

####IMPORTANT:
When placing a $rangeSlider object in or below a dropdown component like a
{$api->getClassLink(SingleAccordion::class)}, the slider will have correct initial positioning but
will jump to one end on the first slide. The initial positioning is calculated when the slider is added to the DOM (which when inside
a dropdown is far off screen), and not when it is first made visible.

The example code of the form showing the exaples of $rangeSlider object is represented below.
MD
);
$exampleViewer(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Forms/RangeSlider.php', false);
echo $parsedown->text(<<<MD

MD
);

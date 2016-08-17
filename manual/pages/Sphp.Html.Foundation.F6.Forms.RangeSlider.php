<?php

namespace Sphp\Html\Foundation\F6\Forms\Inputs;

use Sphp\Html\Foundation\F6\Containers\Accordions\SyntaxHighlightingSingleAccordion as SyntaxHighlightingSingleAccordion;

$rangeSlider = $api->classLinker(RangeSlider::class);


echo $parsedown->text(<<<MD
The example code of the form showing the exaples of $rangeSlider object is represented below.
MD
);
include EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Forms/RangeSlider.php';
SyntaxHighlightingSingleAccordion::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Forms/RangeSlider.php');
echo $parsedown->text(<<<MD

MD
);

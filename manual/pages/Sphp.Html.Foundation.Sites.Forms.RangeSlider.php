<?php

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\Foundation\Sites\Containers\Accordions\SyntaxHighlightingSingleAccordion;

$rangeSlider = $api->classLinker(RangeSlider::class);


echo $parsedown->text(<<<MD
The example code of the form showing the exaples of $rangeSlider object is represented below.
MD
);
include 'Sphp/Html/Foundation/F6/Forms/RangeSlider.php';
SyntaxHighlightingSingleAccordion::visualize('Sphp/Html/Foundation/F6/Forms/RangeSlider.php');
echo $parsedown->text(<<<MD

MD
);

<?php

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\Foundation\Sites\Containers\Accordions\SyntaxHighlightingSingleAccordion;
use Sphp\Html\Apps\Manual\Apis;

$rangeSlider = Apis::sami()->classLinker(RangeSlider::class);


echo $parsedown->text(<<<MD
The example code of the form showing the exaples of $rangeSlider object is represented below.
MD
);
include 'Sphp/Html/Foundation/Sites/Forms/RangeSlider.php';
SyntaxHighlightingSingleAccordion::visualize('Sphp/Html/Foundation/Sites/Forms/RangeSlider.php');
echo $parsedown->text(<<<MD

MD
);

<?php

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\Foundation\Sites\Containers\Accordions\SyntaxHighlightingSingleAccordion;
use Sphp\Html\Apps\Manual\Apis;

$rangeSlider = Apis::sami()->classLinker(RangeSlider::class);


\Sphp\Manual\parseDown(<<<MD
The example code of the form showing the exaples of $rangeSlider object is represented below.
MD
);
include 'Sphp/Html/Foundation/Sites/Forms/RangeSlider.php';
SyntaxHighlightingSingleAccordion::visualize('Sphp/Html/Foundation/Sites/Forms/RangeSlider.php');
\Sphp\Manual\parseDown(<<<MD

MD
);

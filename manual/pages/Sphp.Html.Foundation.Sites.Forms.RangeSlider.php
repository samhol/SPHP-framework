<?php

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Manual;

$rangeSlider = Manual\api()->classLinker(RangeSlider::class);

Manual\parseDown(<<<MD
The example code of the form showing the exaples of $rangeSlider object is represented below.
MD
);
Manual\example('Sphp/Html/Foundation/Sites/Forms/RangeSlider.php', null, true)->printHtml();

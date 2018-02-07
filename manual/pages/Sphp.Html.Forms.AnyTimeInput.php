<?php

namespace Sphp\Html\Forms\Inputs;

$anyTimeInput = \Sphp\Manual\api()->classLinker(AnyTimeInput::class);

\Sphp\Manual\md(<<<MD
###The $anyTimeInput component
	
**Note!** This element uses [Any+Time™](http://www.ama3.com/anytime/){target="_blank"} DatePicker/TimePicker AJAX Calendar Widget for its functionality.

MD
);

\Sphp\Manual\example('Sphp/Html/Forms/AnyTimeInput.php')
        ->buildAccordion()
        ->addCssClass("form-example")
        ->printHtml();

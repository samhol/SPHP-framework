<?php

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleAccordionBuilder;
use Sphp\Html\Apps\Manual\Apis;
$anyTimeInput = \Sphp\Manual\api()->classLinker(AnyTimeInput::class);
\Sphp\Manual\parseDown(<<<MD
###The $anyTimeInput component
	
**Note!** This element uses [Any+Time™](http://www.ama3.com/anytime/){target="_blank"} DatePicker/TimePicker AJAX Calendar Widget for its functionality.

MD
);
(new CodeExampleAccordionBuilder('Sphp/Html/Forms/AnyTimeInput.php'))
        ->buildAccordion()
        ->addCssClass("form-example")
        ->printHtml();

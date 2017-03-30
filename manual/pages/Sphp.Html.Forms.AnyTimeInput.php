<?php

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

$anyTimeInput = $api->classLinker(AnyTimeInput::class);
echo $parsedown->text(<<<MD
###The $anyTimeInput component
	
**Note!** This element uses [Any+Time™](http://www.ama3.com/anytime/){target="_blank"} DatePicker/TimePicker AJAX Calendar Widget for its functionality.

MD
);
(new CodeExampleBuilder('Sphp/Html/Forms/AnyTimeInput.php'))
        ->addCssClass("form-example")
        ->printHtml();

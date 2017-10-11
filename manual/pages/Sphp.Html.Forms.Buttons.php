<?php

namespace Sphp\Html\Forms\Buttons;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$submitter = Apis::sami()->classLinker(Submitter::class);
$reseter = Apis::sami()->classLinker(Resetter::class);
$button = Apis::sami()->classLinker(Button::class);
\Sphp\Manual\parseDown(<<<MD
###The $submitter component
	
* $submitter is a submit button (submits form-data)
* $reseter is a reset button (resets the form-data to its initial values)
* $button is is a clickable button
        
MD
);
CodeExampleBuilder::build('Sphp/Html/Forms/Buttons/AbstractButton.php', 'html5')
        ->buildAccordion()
        ->addCssClass("form-example")
        ->printHtml();

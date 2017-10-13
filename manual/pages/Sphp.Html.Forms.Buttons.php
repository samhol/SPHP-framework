<?php

namespace Sphp\Html\Forms\Buttons;

use Sphp\Manual as Man;

$ns = Man\api()->namespaceBreadGrumbs(__NAMESPACE__);
$buttonInterface = Man\api()->classLinker(ButtonInterface::class);
$submitter = Man\api()->classLinker(Submitter::class);
$reseter = Man\api()->classLinker(Resetter::class);
$button = Man\api()->classLinker(Button::class);
Man\parseDown(<<<MD
###The $buttonInterface components
        
$ns	
        
* $submitter is a submit button (submits form-data)
* $reseter is a reset button (resets the form-data to its initial values)
* $button is is a clickable button
        
MD
);

namespace Sphp\Html\Forms\Inputs\Buttons;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Manual as Man;

$ns = Man\api()->namespaceBreadGrumbs(__NAMESPACE__);
$submitter = Man\api()->classLinker(Submitter::class);
$reseter = Man\api()->classLinker(Resetter::class);
$button = Man\api()->classLinker(Button::class);
Man\parseDown(<<<MD

        
$ns	
        
* $submitter is a submit button (submits form-data)
* $reseter is a reset button (resets the form-data to its initial values)
* $button is is a clickable button
        
MD
);

CodeExampleBuilder::build('Sphp/Html/Forms/Buttons/AbstractButton.php', 'html5')
        ->buildAccordion()
        ->addCssClass('form-example')
        ->printHtml();
Man\loadPage('a');

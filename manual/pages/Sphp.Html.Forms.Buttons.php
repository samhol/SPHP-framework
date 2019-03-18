<?php

namespace Sphp\Html\Forms\Buttons;

use Sphp\Manual;

$ns1 = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

$ns2 = Manual\api()->namespaceBreadGrumbs("Sphp\Html\Forms\Inputs\Buttons");

$buttonInterface = Manual\api()->classLinker(ButtonInterface::class);
$submitter = Manual\api()->classLinker(Submitter::class);
$reseter = Manual\api()->classLinker(Resetter::class);
$button = Manual\api()->classLinker(Button::class);
$buttonTag = Manual\w3schools()->tag('button');
Manual\md(<<<MD
###The $buttonInterface <small>Implementing buttons for HTML forms</small>
        
$ns1	    

Components in this namespace are build using HTML $buttonTag tag.    
        
* $submitter is a submit button (submits form-data)
* $reseter is a reset button (resets the form-data to its initial values)
* $button is is a clickable button
        
MD
);

namespace Sphp\Html\Forms\Inputs\Buttons;

use Sphp\Manual;

$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$submitter = Manual\api()->classLinker(SubmitInput::class);
$reseter = Manual\api()->classLinker(ResetInput::class);
$button = Manual\api()->classLinker(InputButton::class);
$buttonTag = Manual\w3schools()->tag('input');
Manual\md(<<<MD

$ns	
      
Components in this namespace are build using HTML $buttonTag tag.      
        
* $submitter is a submit button (submits form-data)
* $reseter is a reset button (resets the form-data to its initial values)
* $button is is a clickable button
        
MD
);

Manual\example('Sphp/Html/Forms/Buttons/AbstractButton.php', 'html5')
        ->buildAccordion()
        ->addCssClass('form-example')
        ->printHtml();

<?php

namespace Sphp\Html\Forms\Inputs;

use Sphp\Manual;

use Sphp\Html\Forms\FormInterface;

$formIfLink = Manual\api()->classLinker(FormInterface::class);
$inputInterface = Manual\api()->classLinker(Input::class);
$formController = Manual\api()->classLinker(\Sphp\Html\Forms\FormController::class);
$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
Manual\md(<<<MD
##Building HTML forms <small>using $formController and $inputInterface components</small>

$formController is the base interface for all functional form content and $inputInterface inherits it.
Functional form content 
$ns		
All of the following components declare an $inputInterface input control for a $formIfLink form.

MD
);

$baseInput = Manual\api()->classLinker(InputTag::class);
$textualInput = Manual\api()->classLinker(TextualInput::class);
$textInput = Manual\api()->classLinker(TextInput::class);
$textarea = Manual\api()->classLinker(Textarea::class);

Manual\md(<<<MD
###Basic input components
        
Framework has many build-in form components that implement basic HTML form elements.
 * $baseInput and extending classes for spesific input types like:
        * $textualInput and subtypes like:
              * $textInput
 * $textarea
MD
);

Manual\example('Sphp/Html/Forms/Inputs/InputFields.php', 'html5', true)
        ->buildAccordion()
        ->addCssClass("form-example")
        ->printHtml();

//\Sphp\Manual\loadPage('Sphp.Html.Forms.Inputs.Choiceboxes');
Manual\printPage('Sphp.Html.Forms.Menus.Select');
Manual\printPage('Sphp.Html.Forms.AnyTimeInput');
Manual\printPage('Sphp.Html.Forms.IonRangeSlider');

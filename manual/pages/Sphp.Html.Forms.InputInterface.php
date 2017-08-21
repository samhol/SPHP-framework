<?php

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Forms\FormInterface;
use Sphp\Html\Apps\Manual\Apis;

$formIfLink = Apis::sami()->classLinker(FormInterface::class);
$inputInterface = Apis::sami()->classLinker(InputInterface::class);
$ns = Apis::sami()->namespaceBreadGrumbs(__NAMESPACE__);
\Sphp\Manual\parseDown(<<<MD
##Some form components inheriting $inputInterface
$ns		
All of the following components declare an $inputInterface input control for a $formIfLink form.

MD
);

$baseInput = Apis::sami()->classLinker(InputTag::class);
$textualInput = Apis::sami()->classLinker(TextualInput::class);
$textInput = Apis::sami()->classLinker(TextInput::class);
$textarea = Apis::sami()->classLinker(Textarea::class);

\Sphp\Manual\parseDown(<<<MD
###Basic input components
        
Framework has many build-in form components that implement basic HTML form elements like:
 * $baseInput and extending classes for spesific input types like:
        * $textualInput and subtypes like:
              * $textInput
 * $textarea
MD
);

(new CodeExampleBuilder('Sphp/Html/Forms/Inputs/InputFields.php', false, true))
        ->buildAccordion()
        ->addCssClass("form-example")
        ->printHtml();

//\Sphp\Manual\loadPage('Sphp.Html.Forms.Inputs.Choiceboxes');
\Sphp\Manual\loadPage('Sphp.Html.Forms.Menus.Select');
\Sphp\Manual\loadPage('Sphp.Html.Forms.AnyTimeInput');
\Sphp\Manual\loadPage('Sphp.Html.Forms.IonRangeSlider');

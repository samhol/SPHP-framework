<?php

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleAccordionBuilder;
use Sphp\Html\Forms\FormInterface;
use Sphp\Html\Apps\Manual\Apis;

$formIfLink = \Sphp\Manual\api()->classLinker(FormInterface::class);
$inputInterface = \Sphp\Manual\api()->classLinker(InputInterface::class);
$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
\Sphp\Manual\md(<<<MD
##Some form components inheriting $inputInterface
$ns		
All of the following components declare an $inputInterface input control for a $formIfLink form.

MD
);

$baseInput = \Sphp\Manual\api()->classLinker(InputTag::class);
$textualInput = \Sphp\Manual\api()->classLinker(TextualInput::class);
$textInput = \Sphp\Manual\api()->classLinker(TextInput::class);
$textarea = \Sphp\Manual\api()->classLinker(Textarea::class);

\Sphp\Manual\md(<<<MD
###Basic input components
        
Framework has many build-in form components that implement basic HTML form elements like:
 * $baseInput and extending classes for spesific input types like:
        * $textualInput and subtypes like:
              * $textInput
 * $textarea
MD
);

(new CodeExampleAccordionBuilder('Sphp/Html/Forms/Inputs/InputFields.php', 'html5', true))
        ->buildAccordion()
        ->addCssClass("form-example")
        ->printHtml();

//\Sphp\Manual\loadPage('Sphp.Html.Forms.Inputs.Choiceboxes');
\Sphp\Manual\loadPage('Sphp.Html.Forms.Menus.Select');
\Sphp\Manual\loadPage('Sphp.Html.Forms.AnyTimeInput');
\Sphp\Manual\loadPage('Sphp.Html.Forms.IonRangeSlider');

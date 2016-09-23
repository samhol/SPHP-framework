<?php

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;
use Sphp\Html\Forms\FormInterface as FormInterface;

$formIfLink = $api->classLinker(FormInterface::class);
$inputInterface = $api->classLinker(InputInterface::class);
$ns = $api->namespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD
##Some form components inheriting $inputInterface
$ns		
All of the following components declare an $inputInterface input control for a $formIfLink form.

MD
);

$baseInput = $api->classLinker(InputTag::class);
$textualInput = $api->classLinker(TextualInput::class);
$textInput = $api->classLinker(TextInput::class);
$textarea = $api->classLinker(Textarea::class);

echo $parsedown->text(<<<MD
###Basic input components
        
Framework has many build-in form components that implement basic HTML form elements like:
 * $baseInput and extending classes for spesific input types like:
        * $textualInput and subtypes like:
              * $textInput
 * $textarea
MD
);

(new CodeExampleAccordion(EXAMPLE_DIR . 'Sphp/Html/Forms/Inputs/InputFields.php', false, true))
        ->addCssClass("form-example")
        ->printHtml();
(new CodeExampleAccordion(EXAMPLE_DIR . 'Sphp/Html/Forms/Input.php', false, true))
        ->addCssClass("form-example")
        ->printHtml();
$load("Sphp.Html.Forms.Inputs.Choiceboxes.php");
$load("Sphp.Html.Forms.Menus.Select.php");
$load("Sphp.Html.Forms.AnyTimeInput.php");
$load("Sphp.Html.Forms.IonRangeSlider.php");

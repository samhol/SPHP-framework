<?php

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Forms\FormInterface;
use Sphp\Html\Apps\Manual\Apis;

$formIfLink = Apis::apigen()->classLinker(FormInterface::class);
$inputInterface = Apis::apigen()->classLinker(InputInterface::class);
$ns = Apis::apigen()->namespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD
##Some form components inheriting $inputInterface
$ns		
All of the following components declare an $inputInterface input control for a $formIfLink form.

MD
);

$baseInput = Apis::apigen()->classLinker(InputTag::class);
$textualInput = Apis::apigen()->classLinker(TextualInput::class);
$textInput = Apis::apigen()->classLinker(TextInput::class);
$textarea = Apis::apigen()->classLinker(Textarea::class);

echo $parsedown->text(<<<MD
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
(new CodeExampleBuilder('Sphp/Html/Forms/Input.php', false, true))
        ->buildAccordion()
        ->addCssClass("form-example")
        ->printHtml();
$load("Sphp.Html.Forms.Inputs.Choiceboxes.php");
$load("Sphp.Html.Forms.Menus.Select.php");
$load("Sphp.Html.Forms.AnyTimeInput.php");
$load("Sphp.Html.Forms.IonRangeSlider.php");

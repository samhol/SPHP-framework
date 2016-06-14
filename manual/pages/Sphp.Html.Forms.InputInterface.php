<?php

namespace Sphp\Html\Forms;

use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;
use Sphp\Html\Forms\Input\Checkbox as Checkbox;
use Sphp\Html\Forms\Input\Radiobox as Radiobox;

$formIfLink = $api->getClassLink(FormInterface::class);
$inputInterface = $api->getClassLink(InputInterface::class);
$dateInputLink = $api->getClassLink(Input\AnyTimeInput::class);
echo $parsedown->text(<<<MD
##Some form components inheriting $inputInterface
		
All of the following components declare an input control in  a $formIfLink form.

MD
);

$baseInput = $api->classLinker(Input\Input::class);
$textualInput = $api->classLinker(Input\TextualInput::class);
$textInput = $api->classLinker(Input\TextInput::class);
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
(new CodeExampleAccordion(EXAMPLE_DIR . 'Sphp/Html/Forms/Input.php', false, true))
        ->addCssClass("form-example")
        ->printHtml();
$load("Sphp.Html.Forms.AnyTimeInput.php");


(new CodeExampleAccordion(EXAMPLE_DIR . 'Sphp/Html/Forms/Choicebox.php', false, true))
        ->addCssClass("form-example")
        ->printHtml();

$load("Sphp.Html.Forms.Menus.Select.php");
$load("Sphp.Html.Forms.IonRangeSlider.php");


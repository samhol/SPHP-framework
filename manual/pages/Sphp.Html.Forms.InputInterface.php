<?php

namespace Sphp\Html\Forms;

use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;
use Sphp\Html\Forms\Input\TextualInput as TextualInput;
use Sphp\Html\Forms\Input\Checkbox as Checkbox;
use Sphp\Html\Forms\Input\Radiobox as Radiobox;

$formIfLink = $api->getClassLink(FormInterface::class);
$inputInterface = $api->getClassLink(InputInterface::class);
$dateInputLink = $api->getClassLink(Input\DateTimeInput::class);
echo $parsedown->text(<<<MD
#HTML INPUT ELEMENTS: {$api->getNamespaceLink(__NAMESPACE__)} namespace

$formIfLink is a container for all $inputInterface components like
({$api->getClassLink(TextualInput::class)}, {$api->getClassLink(Checkbox::class)}, {$api->getClassLink(Radiobox::class)}, submit buttons and more.
A form can also contain select lists, textarea, fieldset, legend, and label elements.

All of the following components implement atleast $inputInterface and are therefore
suitable to declare input controls in $formIfLink forms.

##The {$api->getNamespaceLink(__NAMESPACE__ . "\\Input")} namespace

These components are implementations of HTML {$w3schools->getTagLink("input")}) tag but they have many different uses.

###Basic inputs


MD
);

$load("Sphp.Html.Forms.IonRangeSlider.php");

(new CodeExampleAccordion(EXAMPLE_DIR . 'Sphp/Html/Forms/InputInterface1.php', false, true))
        ->addCssClass("form-example");

$load("Sphp.Html.Forms.Menus.Select.php");


<?php

namespace Sphp\Html\Foundation\F6\Forms;

use Sphp\Html\Forms\FormInterface as FormInterface;
use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;
use Sphp\Html\Document as Document;

$formIfLink = $api->getClassLink(FormInterface::class);
$gridForm = $api->getClassLink(GridForm::class);

Document::html("manual")->scripts()->appendSrc("manual/js/formTools.js");

echo $parsedown->text(<<<MD
###Examples of $formIfLink Form implementations

####The $gridForm component

MD
);
(new CodeExampleAccordion(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Forms/GridForm.php'))
        ->addCssClass("form-example")
        ->printHtml();
$load("Sphp.Html.Foundation.F6.Forms.Switch.php");
$load("Sphp.Html.Foundation.F6.Forms.Slider.php");
$load("Sphp.Html.Foundation.F6.Forms.RangeSlider.php");

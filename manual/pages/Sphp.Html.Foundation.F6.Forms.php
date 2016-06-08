<?php

namespace Sphp\Html\Foundation\F6\Forms;

use Sphp\Html\Forms\FormInterface as FormInterface;
use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;

$formIfLink = $api->getClassLink(FormInterface::class);
$gridForm = $api->getClassLink(GridForm::class);

echo $parsedown->text(<<<MD
###Examples of $formIfLink Form implementations

####The $gridForm component

MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Forms/GridForm.php');
$load("Sphp.Html.Foundation.F6.Forms.RangeSlider.php");

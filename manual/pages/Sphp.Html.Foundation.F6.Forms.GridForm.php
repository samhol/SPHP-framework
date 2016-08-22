<?php
namespace Sphp\Html\Foundation\F6\Forms;
use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;
$gridForm = $api->classLinker(GridForm::class);

$ns = $api->namespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD

##Foundation based forms and other input containers

$gridForm implements a validable Foundation framework based form. 
$ns
MD
);
(new CodeExampleAccordion(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Forms/GridForm.php'))
        ->setExampleHeading("Basic Foundation form example")
        ->addCssClass("form-example")
        ->printHtml();
(new CodeExampleAccordion(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Forms/Inputs/InputColumnInterface.php'))
        ->addCssClass("form-example")
        ->printHtml();

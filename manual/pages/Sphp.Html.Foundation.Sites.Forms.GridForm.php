<?php
namespace Sphp\Html\Foundation\Sites\Forms;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
$gridForm = $api->classLinker(GridForm::class);

$ns = $api->namespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD

##Foundation based forms and other input containers

$gridForm implements a validable Foundation framework based form. 
$ns
MD
);
(new CodeExampleBuilder('Sphp/Html/Foundation/F6/Forms/GridForm.php'))
        ->setExamplePaneTitle("Basic Foundation form example")
        ->addCssClass("form-example")
        ->printHtml();
(new CodeExampleBuilder('Sphp/Html/Foundation/F6/Forms/Inputs/InputColumnInterface.php'))
        ->addCssClass("form-example")
        ->printHtml();

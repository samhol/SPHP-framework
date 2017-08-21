<?php

namespace Sphp\Html\Foundation\Sites\Forms;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$gridForm = Apis::sami()->classLinker(GridForm::class);

\Sphp\Manual\parseDown(<<<MD

##Foundation based forms and other input containers

$gridForm implements a validable Foundation framework based form. 

MD
);
(new CodeExampleBuilder('Sphp/Html/Foundation/Sites/Forms/Inputs/InputColumnInterface.php'))
        ->buildAccordion()
        ->addCssClass("form-example")
        ->printHtml();

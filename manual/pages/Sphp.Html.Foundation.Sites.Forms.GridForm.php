<?php

namespace Sphp\Html\Foundation\Sites\Forms;

$gridForm = \Sphp\Manual\api()->classLinker(GridForm::class);

\Sphp\Manual\md(<<<MD

##Foundation based forms and other input containers

$gridForm implements a validable Foundation framework based form. 

MD
);
\Sphp\Manual\example('Sphp/Html/Foundation/Sites/Forms/Inputs/InputColumnInterface.php')
        ->buildAccordion()
        ->addCssClass("form-example")
        ->printHtml();

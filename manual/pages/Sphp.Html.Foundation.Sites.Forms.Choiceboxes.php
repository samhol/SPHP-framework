<?php

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

$choiceboxes = \Sphp\Manual\api()->classLinker(AbstractSwitch::class);
$radios = \Sphp\Manual\api()->classLinker(Radioboxes::class);
$checkboxes = \Sphp\Manual\api()->classLinker(Checkboxes::class);


\Sphp\Manual\md(<<<MD
##$radios and $checkboxes components

These components extend $choiceboxes and Foundation frameworks Switches on clientside
MD
);

\Sphp\Manual\example('Sphp/Html/Foundation/Sites/Forms/Choiceboxes.php')
        ->buildAccordion()
        ->addCssClass("form-example")
        ->printHtml();

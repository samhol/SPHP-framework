<?php

namespace Sphp\Html\Foundation\F6\Forms\Inputs;

use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;

$choiceboxes = $api->classLinker(AbstractSwitch::class);
$radios = $api->classLinker(Radioboxes::class);
$checkboxes = $api->classLinker(Checkboxes::class);


echo $parsedown->text(<<<MD
##$radios and $checkboxes components

These components extend $choiceboxes and Foundation frameworks Switches on clientside
MD
);

(new CodeExampleAccordion(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Forms/Choiceboxes.php'))
        ->addCssClass("form-example")
        ->printHtml();
echo $parsedown->text(<<<MD

MD
);

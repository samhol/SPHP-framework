<?php

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$choiceboxes = Apis::apigen()->classLinker(AbstractSwitch::class);
$radios = Apis::apigen()->classLinker(Radioboxes::class);
$checkboxes = Apis::apigen()->classLinker(Checkboxes::class);


echo $parsedown->text(<<<MD
##$radios and $checkboxes components

These components extend $choiceboxes and Foundation frameworks Switches on clientside
MD
);

(new CodeExampleBuilder('Sphp/Html/Foundation/Sites/Forms/Choiceboxes.php'))
        ->buildAccordion()
        ->addCssClass("form-example")
        ->printHtml();
echo $parsedown->text(<<<MD

MD
);

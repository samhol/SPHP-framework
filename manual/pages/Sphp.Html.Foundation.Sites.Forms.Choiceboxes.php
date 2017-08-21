<?php

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$choiceboxes = Apis::sami()->classLinker(AbstractSwitch::class);
$radios = Apis::sami()->classLinker(Radioboxes::class);
$checkboxes = Apis::sami()->classLinker(Checkboxes::class);


\Sphp\Manual\parseDown(<<<MD
##$radios and $checkboxes components

These components extend $choiceboxes and Foundation frameworks Switches on clientside
MD
);

(new CodeExampleBuilder('Sphp/Html/Foundation/Sites/Forms/Choiceboxes.php'))
        ->buildAccordion()
        ->addCssClass("form-example")
        ->printHtml();
\Sphp\Manual\parseDown(<<<MD

MD
);

<?php

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$choiceboxes = \Sphp\Manual\api()->classLinker(AbstractSwitch::class);
$radios = \Sphp\Manual\api()->classLinker(Radioboxes::class);
$checkboxes = \Sphp\Manual\api()->classLinker(Checkboxes::class);


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

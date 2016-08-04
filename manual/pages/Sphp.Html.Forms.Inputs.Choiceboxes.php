<?php

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;
use Sphp\Html\Apps\Manual\Apis as Apis;

$anyTimeInput = Apis::apigen()->classLinker(\Sphp\Html\Forms\Choiceboxes::class);
echo $parsedown->text(<<<MD
##The $anyTimeInput component
	
MD
);
(new CodeExampleAccordion(EXAMPLE_DIR . 'Sphp/Html/Forms/Inputs/Choicebox.php', false, true))
        ->addCssClass("form-example")
        ->printHtml();

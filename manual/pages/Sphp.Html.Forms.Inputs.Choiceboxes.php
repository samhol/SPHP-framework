<?php

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleAccordionBuilder;
use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Forms\Inputs\Choiceboxes as Choiceboxes;

$anyTimeInput = \Sphp\Manual\api()->classLinker(Choiceboxes::class);
\Sphp\Manual\md(<<<MD
##The $anyTimeInput component
	
MD
);
(new CodeExampleAccordionBuilder('Sphp/Html/Forms/Inputs/Choicebox.php', false, true))
        ->buildAccordion()
        ->addCssClass("form-example")
        ->printHtml();

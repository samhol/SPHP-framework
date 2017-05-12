<?php

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Forms\Inputs\Choiceboxes as Choiceboxes;

$anyTimeInput = Apis::sami()->classLinker(Choiceboxes::class);
echo $parsedown->text(<<<MD
##The $anyTimeInput component
	
MD
);
(new CodeExampleBuilder('Sphp/Html/Forms/Inputs/Choicebox.php', false, true))
        ->buildAccordion()
        ->addCssClass("form-example")
        ->printHtml();

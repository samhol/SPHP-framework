<?php

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleAccordionBuilder;
use Sphp\Html\Apps\Manual\Apis;

$abstractSwitch = \Sphp\Manual\api()->classLinker(AbstractSwitch::class);
$radioSwitch = \Sphp\Manual\api()->classLinker(RadioSwitch::class);
$switchBox = \Sphp\Manual\api()->classLinker(SwitchBox::class);


\Sphp\Manual\md(<<<MD
##Buttons

MD
);

(new CodeExampleAccordionBuilder('Sphp/Html/Foundation/Sites/Forms/FileUploadButton.php'))
        ->buildAccordion()
        ->addCssClass('form-example')
        ->printHtml();
\Sphp\Manual\md(<<<MD

MD
);

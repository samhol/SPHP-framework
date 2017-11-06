<?php

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$abstractSwitch = \Sphp\Manual\api()->classLinker(AbstractSwitch::class);
$radioSwitch = \Sphp\Manual\api()->classLinker(RadioSwitch::class);
$switchBox = \Sphp\Manual\api()->classLinker(SwitchBox::class);


\Sphp\Manual\parseDown(<<<MD
##Buttons

MD
);

(new CodeExampleBuilder('Sphp/Html/Foundation/Sites/Forms/FileUploadButton.php'))
        ->buildAccordion()
        ->addCssClass('form-example')
        ->printHtml();
\Sphp\Manual\parseDown(<<<MD

MD
);

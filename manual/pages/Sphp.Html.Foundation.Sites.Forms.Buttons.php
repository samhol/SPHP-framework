<?php

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$abstractSwitch = Apis::sami()->classLinker(AbstractSwitch::class);
$radioSwitch = Apis::sami()->classLinker(RadioSwitch::class);
$switchBox = Apis::sami()->classLinker(SwitchBox::class);


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

<?php

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

$abstractSwitch = $api->classLinker(AbstractSwitch::class);
$radioSwitch = $api->classLinker(RadioSwitch::class);
$switchBox = $api->classLinker(SwitchBox::class);


echo $parsedown->text(<<<MD
##Buttons

MD
);

(new CodeExampleBuilder('Sphp/Html/Foundation/Sites/Forms/FileUploadButton.php'))
        ->buildAccordion()
        ->addCssClass('form-example')
        ->printHtml();
echo $parsedown->text(<<<MD

MD
);

<?php

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

$abstractSwitch = $api->classLinker(AbstractSwitch::class);
$radioSwitch = $api->classLinker(RadioSwitch::class);
$switchBox = $api->classLinker(SwitchBox::class);


echo $parsedown->text(<<<MD
##$radioSwitch and $switchBox components

These components extend $abstractSwitch and Foundation frameworks Switches on clientside
MD
);

(new CodeExampleBuilder('Sphp/Html/Foundation/F6/Forms/FileUploadButton.php'))
        ->buildAccordion()
        ->addCssClass('form-example')
        ->printHtml();
echo $parsedown->text(<<<MD

MD
);

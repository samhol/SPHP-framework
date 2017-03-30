<?php

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$abstractSwitch = Apis::apigen()->classLinker(AbstractSwitch::class);
$radioSwitch = Apis::apigen()->classLinker(RadioSwitch::class);
$switchBox = Apis::apigen()->classLinker(SwitchBox::class);


echo $parsedown->text(<<<MD
##$radioSwitch and $switchBox components

These components extend $abstractSwitch and Foundation frameworks Switches on clientside
MD
);

(new CodeExampleBuilder('Sphp/Html/Foundation/F6/Forms/AbstractSwitch.php'))
        ->buildAccordion()
        ->addCssClass("form-example")
        ->printHtml();
echo $parsedown->text(<<<MD

MD
);

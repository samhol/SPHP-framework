<?php

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$abstractSwitch = Apis::sami()->classLinker(AbstractSwitch::class);
$radioSwitch = Apis::sami()->classLinker(RadioSwitch::class);
$switchBox = Apis::sami()->classLinker(SwitchBox::class);


echo $parsedown->text(<<<MD
##$radioSwitch and $switchBox components

These components extend $abstractSwitch and Foundation frameworks Switches on clientside
MD
);

(new CodeExampleBuilder('Sphp/Html/Foundation/Sites/Forms/AbstractSwitch.php'))
        ->buildAccordion()
        ->addCssClass("form-example")
        ->printHtml();


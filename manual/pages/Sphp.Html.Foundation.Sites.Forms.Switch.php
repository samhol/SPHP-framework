<?php

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$abstractSwitch = \Sphp\Manual\api()->classLinker(AbstractSwitch::class);
$radioSwitch = \Sphp\Manual\api()->classLinker(RadioSwitch::class);
$switchBox = \Sphp\Manual\api()->classLinker(SwitchBox::class);


\Sphp\Manual\parseDown(<<<MD
##$radioSwitch and $switchBox components

These components extend $abstractSwitch and Foundation frameworks Switches on clientside
MD
);

(new CodeExampleBuilder('Sphp/Html/Foundation/Sites/Forms/AbstractSwitch.php'))
        ->buildAccordion()
        ->addCssClass("form-example")
        ->printHtml();


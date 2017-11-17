<?php

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Manual;

$abstractSwitch = Manual\api()->classLinker(AbstractSwitch::class);
$radioSwitch = Manual\api()->classLinker(RadioSwitch::class);
$switchBox = Manual\api()->classLinker(SwitchBox::class);


Manual\parseDown(<<<MD
##$radioSwitch and $switchBox components

These components extend $abstractSwitch and Foundation frameworks Switches on clientside
MD
);

Manual\example('Sphp/Html/Foundation/Sites/Forms/AbstractSwitch.php')
        ->buildAccordion()
        ->addCssClass('form-examples')
        ->printHtml();


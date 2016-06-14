<?php

namespace Sphp\Html\Foundation\F6\Forms;

use Sphp\Html\Forms\SliderInterface as SliderInterface;
use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;

$abstractSwitch = $api->getClassLink(AbstractSwitch::class);
$radioSwitch = $api->getClassLink(RadioSwitch::class);
$switchBox = $api->getClassLink(SwitchBox::class);


echo $parsedown->text(<<<MD
##$radioSwitch and $switchBox components

These components extend $abstractSwitch and Foundation frameworks Switches on clientside
MD
);

(new CodeExampleAccordion(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Forms/AbstractSwitch.php'))
        ->addCssClass("form-example")
        ->printHtml();
echo $parsedown->text(<<<MD

MD
);

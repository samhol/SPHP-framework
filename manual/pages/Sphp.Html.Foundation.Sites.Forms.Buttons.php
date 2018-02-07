<?php

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

$abstractSwitch = \Sphp\Manual\api()->classLinker(AbstractSwitch::class);
$radioSwitch = \Sphp\Manual\api()->classLinker(RadioSwitch::class);
$switchBox = \Sphp\Manual\api()->classLinker(SwitchBox::class);

\Sphp\Manual\md(<<<MD
##Buttons

MD
);

\Sphp\Manual\example('Sphp/Html/Foundation/Sites/Forms/FileUploadButton.php')
        ->buildAccordion()
        ->addCssClass('form-example')
        ->printHtml();

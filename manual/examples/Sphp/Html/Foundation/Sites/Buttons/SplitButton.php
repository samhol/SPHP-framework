<?php

namespace Sphp\Html\Foundation\Sites\Buttons;

use Sphp\Html\Foundation\Sites\Containers\Dropdown;

$split1 = (new SplitButton("default action"))
        ->setSize("small")
        ->setColor("success");
$split2 = (new SplitButton(Button::hyperlink("http://samiholck.com/", "samiholck.com", "_blank")))
        ->setSize("small")
        ->setColor("secondary");
$dd = new Dropdown($split2->secondaryButton(), "Hello! I'm a dropdown");

echo "$split1 $split2 {$dd->getDropdown()}";

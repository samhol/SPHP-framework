<?php

namespace Sphp\Html\Foundation\Sites\Buttons;

use Sphp\Html\Foundation\Sites\Grids\BlockGrid as BlockGrid;

$split1 = (new SplitButton("default action"))
        ->setSize("small")
        ->setColor("success");
$split2 = (new SplitButton(Button::hyperlink("http://samiholck.com/", "samiholck.com", "_blank")))
        ->setSize("small")
        ->setColor("secondary");
$grid = (new BlockGrid())
        ->append($split1)
        ->append($split2)
        ->printHtml();

<?php

namespace Sphp\Html\Foundation\F6\Buttons;

use Sphp\Html\Foundation\F6\Grids\BlockGrid as BlockGrid;

$split1 = (new SplitButton("default action"))
        ->setSize("small")
        ->setColor("success");
$split2 = (new SplitButton(new HyperlinkButton("http://samiholck.com/", "samiholck.com", "_blank")))
        ->setSize("small")
        ->setColor("secondary");
$grid = (new BlockGrid())
        ->append($split1)
        ->append($split2)
        ->printHtml();
?>

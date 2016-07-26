<?php

namespace Sphp\Html\Foundation\F6\Buttons;

use Sphp\Html\Foundation\F6\Grids\BlockGrid as BlockGrid;

$buttons[] = new HyperlinkButton("http://www.google.com/", "google", "engine");
$buttons[] = new HyperlinkButton("http://www.bing.com", "Bing", "engine");
$buttons[] = new HyperlinkButton("http://www.ask.com/", "ask.com", "engine");

$buttonGroup1 = (new ButtonGroup())
        ->appendLink("https://www.yahoo.com/", "Yahoo!", "engine")
        ->appendButtons($buttons)
        ->setSize("tiny");

$buttonGroup2 = (new ButtonGroup($buttons))
        ->setSize("small");

$grid = new BlockGrid($buttonGroup1, 3);
$grid->append($buttonGroup2);

$buttonGroup3 = clone $buttonGroup2;
$buttonGroup3
        ->setSize("large")
        ->setColor("success");
$grid->append($buttonGroup3);
$grid->printHtml();
?>

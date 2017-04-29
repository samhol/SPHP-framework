<?php

namespace Sphp\Html\Foundation\Sites\Buttons;

use Sphp\Html\Foundation\Sites\Grids\BlockGrid as BlockGrid;

$google = (new HyperlinkButton("http://www.google.com/", "Google", "engine"))
        ->setSize("large")
        ->setColor("alert");
$bing = (new HyperlinkButton("http://www.bing.com", "Bing", "engine"))
        ->setSize("large")
        ->setColor("warning");
$ask = (new HyperlinkButton("http://www.ask.com/", "ask.com", "engine"))
        ->setSize("large")
        ->setColor("success");
$yahoo = (new HyperlinkButton("https://www.yahoo.com/", "Yahoo!", "engine"))
        ->setSize("large")
        ->setColor("disabled");

$grid = new BlockGrid();
$grid->setBlockGrids(2, 3, 4)->append($google)
        ->append($bing)
        ->append($ask)
        ->append($yahoo);

foreach ($grid as $column) {
  $column->addCssClass("text-center");
}
$grid->printHtml();
?>

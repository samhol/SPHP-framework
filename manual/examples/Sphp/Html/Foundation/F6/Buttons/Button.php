<?php

namespace Sphp\Html\Foundation\F6\Buttons;

use Sphp\Html\Foundation\F6\Grids\Grid as Grid;

$google = new HyperlinkButton("http://www.google.com/", "google.com", "test");
$bing = new HyperlinkButton("http://www.bing.com", "Bing", "test");
$ask = new HyperlinkButton("http://www.ask.com/", "ask.com", "test");
$samiholck = (new HyperlinkButton("http://samiholck.com/", "samiholck.com", "test"))
        ->setLarge()
        ->setColor("alert")
        ->setExpanded();
$apigen = (new HyperlinkButton("http://apigen.samiholck.com/", "apigen", "test"))
        ->setSmall()
        ->setColor("success");
$phpdoc = (new HyperlinkButton("http://phpdoc.samiholck.com/", "phpdoc", "test"))
        ->setSmall()
        ->setColor("warning");
$grid = new Grid();
$grid[] = [
    $google->setSize("tiny"),
    $bing->setSize("small"),
    $ask->setSize("large")];
$grid[] = $samiholck->setSize("expand");
$grid[] = [$apigen, $phpdoc];
foreach ($grid->getColumns() as $column) {
  $column->addCssClass("text-center");
}
$grid->printHtml();
?>

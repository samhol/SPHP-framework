<?php

namespace Sphp\Html\Foundation\Buttons;

use Sphp\Html\Foundation\Structure\Grid as Grid;

$buttonGroup1 = (new ButtonGroup())
		->appendLink("http://www.google.com/", "google.com", "engine")
		->appendButton(new HyperlinkButton("www.bing.com", "Bing", "engine"))
		->appendLink("http://www.ask.com/", "ask.com", "engine");
$buttonBar1 = (new ButtonBar())
		->appendGroup($buttonGroup1)
		->createGroup([
			new HyperlinkButton("http://www.samiholck.com", "samiholck.com", "samiholck"),
			new HyperlinkButton("http://apigen.samiholck.com/", "apigen", "samiholck"),
			new HyperlinkButton("http://phpdoc.samiholck.com/", "phpdoc", "samiholck")])
		->setBorderRadius("radius");
$grid = new Grid();
$grid[] = $buttonBar1;
$buttonBar2 = clone $buttonBar1;
$grid[] = $buttonBar2
		->setBorderRadius("round")
		->setSize("tiny");
foreach ($grid->getColumns() as $column) {
	$column->addCssClass("text-center");
}
$grid->printHtml();
?>
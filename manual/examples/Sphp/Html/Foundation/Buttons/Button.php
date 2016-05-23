<?php

namespace Sphp\Html\Foundation\Buttons;
use Sphp\Html\Foundation\Structure\Grid as Grid;

$google = new HyperlinkButton("http://www.google.com/", "google.com", "test");
$bing = new HyperlinkButton("http://www.bing.com", "Bing", "test");
$ask = new HyperlinkButton("http://www.ask.com/", "ask.com", "test");
$samiholck = (new HyperlinkButton("http://samiholck.com/", "samiholck.com", "test"))
		->setLarge()
		->alertColor()
		->setBorderRadius("round")
		->setExpanded();
$apigen = (new HyperlinkButton("http://apigen.samiholck.com/", "apigen", "test"))
		->setSmall()
		->successColor()
		->setBorderRadius("radius");
$phpdoc = (new HyperlinkButton("http://phpdoc.samiholck.com/", "phpdoc", "test"))
		->setSmall()
		->secondaryColor()
		->setBorderRadius("radius");
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
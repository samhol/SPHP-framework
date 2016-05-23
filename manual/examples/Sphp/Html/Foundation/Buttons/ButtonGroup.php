<?php

namespace Sphp\Html\Foundation\Buttons;

use Sphp\Html\Foundation\Structure\Grid as Grid;

$buttonGroup1 = (new ButtonGroup())
		->appendLink("http://www.google.com/", "google.com", "engine")
		->appendButton(new HyperlinkButton("http://www.bing.com", "Bing", "engine"))
		->appendLink("http://www.ask.com/", "ask.com", "engine")
		->setSize("tiny");
$buttonGroup2 = clone $buttonGroup1;

$grid = new Grid();
$grid[] = $buttonGroup1;
$grid[] = $buttonGroup2
		->setBorderRadius("radius")
		->setSize("small");
$buttonGroup3 = clone $buttonGroup2;
$grid[] = $buttonGroup3
		->setBorderRadius("round")
		->setSize("large");
$buttonGroup4 = clone $buttonGroup3;
$grid[] = $buttonGroup4
		->stack(ButtonGroup::ALL_SCREENS)
		->setSize("large");
$grid->printHtml();
?>
<?php

namespace Sphp\Html\Foundation\F6\Buttons;

use Sphp\Html\Foundation\F6\Core\Grid as Grid;

$split1 = (new SplitButton("default action", "Secondary action"))
		->setSize("small")
		->setColor("success");
$split2 = (new SplitButton(new HyperlinkButton("http://samiholck.com/", "samiholck.com", "_blank"), new Button("button", "secondary")))
		->setSize("small")
		->setColor("secondary");
$grid = new Grid();
$grid[] = [$split1, $split2];
foreach ($grid->getColumns() as $column) {
	//$column->addCssClass("text-center");
}
$grid->printHtml();
?>

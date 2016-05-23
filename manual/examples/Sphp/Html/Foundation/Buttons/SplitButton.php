<?php

namespace Sphp\Html\Foundation\Buttons;

use Sphp\Html\Navigation\Hyperlink as Hyperlink;
use Sphp\Html\Foundation\Structure\Grid as Grid;

$split1 = (new SplitButton("http://www.thesearchenginelist.com/", "The Search Engine List", "engines"))
		->createlink("http://www.javascriptsearch.org/", "javascriptsearch.org", "engines")
		->appendLinks([
			new Hyperlink("http://www.google.com/", "google.com", "engines"),
			new Hyperlink("http://www.bing.com", "Bing", "engines"),
			new Hyperlink("http://www.ask.com/", "ask.com", "engines")])
		->setSize("small")
		->setColor("success")
		->setBorderRadius("radius");
$split2 = (new SplitButton("http://samiholck.com/", "samiholck.com"))
		->createlink("http://sphp.samiholck.com/", "SPHP framework", "_self")
		->appendLink(new Hyperlink("http://apigen.samiholck.com/", "apigen"))
		->setSize("small")
		->setColor("secondary")
		->setBorderRadius("radius");
$grid = new Grid();
$grid[] = [$split1, $split2];
foreach ($grid->getColumns() as $column) {
	//$column->addCssClass("text-center");
}
$grid->printHtml();
?>
<?php

namespace Sphp\Html\Foundation\Structure;

use Sphp\Html\Document as Document;

foreach (VisibilityHandler::getScreenTypeMap() as $const => $name) {
	(new VisibilityHandler(Document::get("p", "show Only For $name")))
		->showOnlyFor($const)
		->printHtml();
}

?>
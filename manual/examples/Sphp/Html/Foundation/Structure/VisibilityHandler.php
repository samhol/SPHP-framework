<?php

namespace Sphp\Html\Foundation\Structure;

use Sphp\Html\Doc as Doc;

foreach (VisibilityHandler::getScreenTypeMap() as $const => $name) {
	(new VisibilityHandler(Doc::get("p", "show Only For $name")))
		->showOnlyFor($const)
		->printHtml();
}

?>
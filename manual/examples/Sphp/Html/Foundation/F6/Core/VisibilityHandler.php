<?php

namespace Sphp\Html\Foundation\F6\Core;

use Sphp\Html\Doc as Doc;

foreach (VisibilityHandler::getScreenTypeMap() as $const => $name) {
	(new VisibilityHandler(Doc::get("p", "show Only For $name")))
		->showOnlyFor($const)
		->printHtml();
}

?>
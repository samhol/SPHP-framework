<?php

namespace Sphp\Html\Foundation\Sites\Core; 

use Sphp\Html\Document; 
foreach (Screen::sizes() as $name) {
	(new VisibilityAdapter(Document::get("p", "Show for $name and up")))
		->showFromUp($name)
		->printHtml();
    (new VisibilityAdapter(Document::get("p", "Hide for $name and up")))
		->hideDownTo($name)
		->printHtml();
}
foreach (Screen::sizes() as $name) {
	(new VisibilityAdapter(Document::get("p", "show Only For $name")))
		->showOnlyFor($name)
		->printHtml();
}
(new VisibilityAdapter(Document::get("p", "Show between small and large screens")))
		->showBetweenSizes("small", "large")
		->printHtml();
(new VisibilityAdapter(Document::get("p", "Show between medium and xlarge screens")))
		->showBetweenSizes("medium", "xlarge")
		->printHtml();
(new VisibilityAdapter(Document::get("p", "Show between medium and xxlarge screens")))
		->showBetweenSizes("medium", "xxlarge")
		->printHtml();
(new VisibilityAdapter(Document::get("p", "Hide from small and large screens")))
		->hideOnlyFromSize("large")->hideOnlyFromSize("small")
		->printHtml();


?>

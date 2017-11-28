<?php

namespace Sphp\Html\Foundation\Sites\Core;

use Sphp\Html\TagFactory;
foreach (Screen::sizes() as $name) {
	(new VisibilityAdapter(TagFactory::p("Show for $name and up")))
		->showFromUp($name)
		->printHtml();
    (new VisibilityAdapter(TagFactory::p("Hide for $name and up")))
		->hideDownTo($name)
		->printHtml();
}
foreach (Screen::sizes() as $name) {
	(new VisibilityAdapter(TagFactory::p("show Only For $name")))
		->showOnlyFor($name)
		->printHtml();
}
(new VisibilityAdapter(TagFactory::p("Show between small and large screens")))
		->showBetweenSizes("small", "large")
		->printHtml();
(new VisibilityAdapter(TagFactory::p("Show between medium and xlarge screens")))
		->showBetweenSizes("medium", "xlarge")
		->printHtml();
(new VisibilityAdapter(TagFactory::p("Show between medium and xxlarge screens")))
		->showBetweenSizes("medium", "xxlarge")
		->printHtml();
(new VisibilityAdapter(TagFactory::p("Hide from small and large screens")))
		->hideOnlyForSize("large")->hideOnlyForSize("small")
		->printHtml();

?>

<?php

namespace Sphp\Html\Foundation\F6\Navigation;


$nav = (new AccordionMenu("Navigator"))
		->appendLink("http://www.google.com/", "Google", "google")
		->appendText("More Google")
		->appendLink("http://www.google.com/", "Google", "google")
		->appendLink("http://www.google.com/", "Google", "google")
		->appendLink("http://www.google.com/", "Google", "google")
		->appendLink("http://www.google.com/", "Google", "google")
		->printHtml();


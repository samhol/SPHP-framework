<?php

namespace Sphp\Html\Foundation\Navigation\SideNav;


$nav = (new SideNav("Navigator"))
		->appendLink("http://www.google.com/", "Google", "google")
		->appendHeading("More Google")
		->appendLink("http://www.google.com/", "Google", "google")
		->appendLink("http://www.google.com/", "Google", "google")
		->appendDivider()
		->appendLink("http://www.google.com/", "Google", "google")
		->appendLink("http://www.google.com/", "Google", "google")
		->printHtml();


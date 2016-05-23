<?php

namespace Sphp\Html\Head;

$head = (new Head("Document title", "utf-8"));
$head->setBaseAddr("http://samiholck.com/", "_self")
		->addCssSrc("sph/css/ion.rangeSlider.css")
		->appendScriptSrc("http://code.jquery.com/jquery-2.1.3.min.js")
		->addShortcutIcon("sph/favicon.ico")
		->setBaseAddr("http://samiholck.com/", "_self")
		->metaTags()
			->setApplicationName("Sphp")
			->setAuthor("Sami Holck")
			->setKeywords("nothing interesting here")
			->setDescription("What ever");
$head->printHtml();
?>

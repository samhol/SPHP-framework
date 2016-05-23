<?php

namespace Sphp\Html\Head;

$head = (new Head("Document title", "utf-8"));
$head->setBaseAddr("http://sphp.samiholck.com/", "_self")
		->enableSPHP()
		->addShortcutIcon("sph/favicon.ico")
		->metaTags()
			->setApplicationName("App for dummies")
			->setAuthor("Sami Holck")
			->setKeywords("keywords")
			->setDescription("An example of a head component");
$head->printHtml();
?>
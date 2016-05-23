<?php

namespace Sphp\Gettext;

Locale::setMessageLocale("fi_FI");

$translator = new Translator();
var_dump(
	$translator->getPlural("%d directory", "%d directories", 0), 
	$translator->getPlural("%d directory", "%d directories", 1), 
	$translator->getPlural("%d directory", "%d directories", 2), 
	$translator->getPlural("%d directory", "%d directories", -3), 
	$translator->getPlural("%d file. Total size: At least %s", "%d files. Total size: At least %s", 3));
?>
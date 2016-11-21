<?php


namespace Sphp\Core\Gettext;

//Locale::setMessageLocale("fi_FI");
echo (new Translator("fi_FI", \Sphp\DEFAULT_DOMAIN, \Sphp\LOCALE_PATH))
		->get("Default system language");

?>

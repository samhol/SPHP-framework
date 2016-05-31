<?php


namespace Sphp\Core\Gettext;

Locale::setMessageLocale("fi_FI");
echo (new Translator(\Sphp\DEFAULT_DOMAIN, \Sphp\LOCALE_PATH))
		->get("Default system language");

?>

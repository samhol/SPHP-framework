<?php

namespace Sphp\Core\I18n\Gettext;

//Locale::setMessageLocale("fi_FI");

$translator = new Translator('fi_FI');
$month = date("F");
echo "$month: " . $translator->get($month) . "\n";
$translator->setLang("en_US");
echo "$month: " . $translator->get($month, "fi_FI") . "\n";
$weekday = date("l");
echo "$weekday: " . $translator->get($weekday, "fi_FI") . "\n";
?>

<?php

namespace Sphp\Core\Gettext;

Locale::setMessageLocale("fi_FI");

$translator = new Translator();
$month = date("F");
echo "$month: " . $translator->get($month) . "\n";
Locale::setMessageLocale("en_US");
echo "$month: " . $translator->get($month, "fi_FI") . "\n";
$weekday = date("l");
echo "$weekday: " . $translator->get($weekday, "fi_FI") . "\n";
?>
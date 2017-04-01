<?php

namespace Sphp\I18n\Gettext;

$translator = new Translator();
$translator->setLang('fi_FI');
$month = date('F');
echo "$month: " . $translator->get($month) . "\n";
$translator->setLang("en_US");
echo "$month: " . $translator->get($month) . "\n";
$weekday = date('l');
echo "$weekday: " . $translator->get($weekday, 'fi_FI') . "\n";
?>

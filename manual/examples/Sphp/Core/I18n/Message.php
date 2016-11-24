<?php

namespace Sphp\Core\I18n;

//Locale::setMessageLocale("fi_FI");
$msg1 = new Message("%s", ["first"]);
echo "message 1: $msg1\n";
$msg2 = new Message("%s", ["second"]);
echo "message 2: $msg2\n";
$msg3 = new Message("Please insert atleast %s of the following characters (%s)", [2, "a, b, c"]);
echo "message 3 in english: {$msg3->setLang('en_US')}\n";
echo "message 3 in finnish: {$msg3->setLang('fi_FI')}\n";
?>

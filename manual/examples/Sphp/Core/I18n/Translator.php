<?php

namespace Sphp\Core\I18n;

//Locale::setMessageLocale("fi_FI");

$translator = new Translator('fi_FI.utf8');
var_dump(
	$translator->vsprintf("Please insert atleast %s of the following characters (%s)", [2, "a, b, c"]), 
	$translator->vsprintf("Please insert atleast %s of the following characters (%s)", [2, "a, b, c"]),
	$translator->vsprintfPlural("%d file. Total size: At least %s", "%d files. Total size: At least %s", 3, [3, "20kB"]));
print_r($translator->get(["open", "close", ["save", "delete", "update"]]));
?>

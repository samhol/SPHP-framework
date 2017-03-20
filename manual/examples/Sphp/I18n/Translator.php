<?php

namespace Sphp\I18n\Gettext;

$translator = new Translator('fi_FI');
var_dump(
	$translator->vsprintf("Please insert atleast %s of the following characters (%s)", [3, "a, b, c, d, e"]), 
	$translator->vsprintf("Please insert atleast %s of the following characters (%s)", [1, "a, b, c"]),
	$translator->vsprintfPlural("%d file. Total size: At least %s", "%d files. Total size: At least %s", 3, [3, "20kB"]));
print_r($translator->get(["open", "close", ["save", "delete", "update"]]));
?>

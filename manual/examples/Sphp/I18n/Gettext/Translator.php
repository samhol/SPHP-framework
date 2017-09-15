<?php

namespace Sphp\I18n\Gettext;

$translator = new Translator();
$translator->setLang('fi_FI');
echo $translator->vsprintf("Please insert atleast %s of the following characters (%s)", [3]);
var_dump(
        $translator->vsprintf("Please insert atleast %s of the following characters (%s)", [3, "a, b, c, d, e"]),
        $translator->vsprintf("Please insert atleast %s of the following characters (%s)", [1, "a, b, c"]),
        $translator->vsprintfPlural("%d file. Total size: At least %s", "%d files. Total size: At least %s", 3, [3, "20kB"]));
print_r($translator->translateArray(["open", "close", ["save", "delete", "update"]]));

var_dump(
        $translator->getPlural("%d directory", "%d directories", 0),
        $translator->getPlural("%d directory", "%d directories", 1),
        $translator->getPlural("%d directory", "%d directories", 2),
        $translator->getPlural("%d directory", "%d directories", -3),
        $translator->getPlural("%d file. Total size: At least %s", "%d files. Total size: At least %s", 3));

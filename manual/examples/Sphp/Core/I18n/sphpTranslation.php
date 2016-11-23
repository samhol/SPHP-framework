<?php

namespace Sphp\Core\I18n\Gettext;

echo (new Translator("fi_FI", \Sphp\DEFAULT_DOMAIN, \Sphp\LOCALE_PATH))
        ->get("Default system language");
?>

<?php

namespace Sphp\I18n\Gettext;

echo (new Translator("fi_FI", \Sphp\DEFAULT_DOMAIN, 'sphp/locale'))
        ->get("Default system language");
?>

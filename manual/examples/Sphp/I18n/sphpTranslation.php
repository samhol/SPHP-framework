<?php

namespace Sphp\I18n\Gettext;

echo (new Translator('Sphp.Defaults', 'sphp/locale'))
        ->setLang('fi_FI')
        ->get("Default system language");

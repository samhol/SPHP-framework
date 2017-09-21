<?php

namespace Sphp\I18n;

use Sphp\I18n\Gettext\Translator;

Translators::instance()->setDefault(new Translator('Sphp.Defaults', 'sphp/locale'));
/*setlocale(LC_MESSAGES, 'fi_FI');
bindtextdomain('Sphp.Defaults', 'sphp/locale');
textdomain('Sphp.Defaults');
bind_textdomain_codeset('Sphp.Defaults', 'UTF-8');
echo gettext('Default system language');*/

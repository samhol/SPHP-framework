<?php

setlocale(LC_MESSAGES, 'fi_FI');
bindtextdomain('Sphp.Defaults', 'sphp/locale');
textdomain('Sphp.Defaults');
bind_textdomain_codeset('Sphp.Defaults', 'UTF-8'); 
echo gettext('Default system language');

?>
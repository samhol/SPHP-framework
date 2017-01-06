<?php

setlocale(LC_MESSAGES, "fi_FI");
bindtextdomain(Sphp\DEFAULT_DOMAIN, 'sphp/locale');
textdomain(Sphp\DEFAULT_DOMAIN);
bind_textdomain_codeset(Sphp\DEFAULT_DOMAIN, 'UTF-8'); 
echo gettext("Default system language");

?>

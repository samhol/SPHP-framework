<?php

setlocale(LC_MESSAGES, "fi_FI");
bindtextdomain(Sphp\DEFAULT_DOMAIN, Sphp\LOCALE_PATH);
textdomain(Sphp\DEFAULT_DOMAIN);
bind_textdomain_codeset(Sphp\DEFAULT_DOMAIN, 'UTF-8'); 
bind_textdomain_codeset(Sphp\DEFAULT_DOMAIN, 'ISO-8859-1'); 
echo gettext("Default system language");

?>
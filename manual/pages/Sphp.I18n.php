<?php

namespace Sphp\I18n;

use Sphp\Html\Apps\Manual\Apis;

$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$php = Apis::phpManual();
$gettext = Apis::phpManual()->extensionLink('gettext', 'Gettext');
\Sphp\Manual\parseDown(<<<MD
#<span class="strict">I18n:</span> <small>Internationalization and localization</small>

$ns

Internationalization (i18n) is the process of developing products in such a way 
that they can be localized for languages and cultures easily. Localization (l10n), 
is the process of adapting applications and text to enable their usability in a 
particular cultural or linguistic market.

This framework comes with buildin English to Finnish translations:
        

* [Translations search engine](manual/po/poViewer.php){target="_blank"}

MD
);
require_once 'manual/examples/Sphp/I18n/Gettext/localeSetting.php';
\Sphp\Manual\loadPage('Sphp.I18n.TranslatorInterface');
\Sphp\Manual\loadPage('Sphp.I18n.Messages');
\Sphp\Manual\loadPage('Sphp.I18n.Collections');
\Sphp\Manual\loadPage('Sphp.I18n.Datetime');

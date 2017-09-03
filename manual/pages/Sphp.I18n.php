<?php

namespace Sphp\I18n;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$ns = Apis::sami()->namespaceBreadGrumbs(__NAMESPACE__);
$php = Apis::phpManual();
$gettext = Apis::phpManual()->extensionLink("gettext", "Gettext");
\Sphp\Manual\parseDown(<<<MD
#<span class="strict">I18n:</span> <small>Internationalization and localization</small>

$ns
  
Internationalization (i18n) is the process of developing products in such a way 
that they can be localized for languages and cultures easily. Localization (l10n), 
is the process of adapting applications and text to enable their usability in a 
particular cultural or linguistic market.

MD
);

$translator = Apis::sami()->classLinker(TranslatorInterface::class);

\Sphp\Manual\parseDown(<<<MD
##The $translator
        
The translator itself is initialized without any parameters, as any configuration 
to it is optional. A translator without any translations will do nothing but return 
all messages verbatim.

The $translator is the base interface for all human language translation related 
operations in this framework. It translates given input by using PHP's build in 
gettext extension and the current locale information provided by the locale.
MD
);

CodeExampleBuilder::visualize('Sphp/I18n/sphpTranslation.php', 'text', false);

\Sphp\Manual\parseDown(<<<MD
The $translator class supports both basic...
MD
);
CodeExampleBuilder::visualize('Sphp/I18n/Translator.singular.php', 'text', false);

\Sphp\Manual\parseDown(<<<MD
...and plural Gettext translation.
MD
);
CodeExampleBuilder::visualize('Sphp/I18n/Translator.plural.php', 'text', false);

$vsprintfLink = Apis::phpManual()->functionLink("vsprintf");
\Sphp\Manual\parseDown(<<<MD
The $translator class has also a method similar to PHP's native $vsprintfLink 
function for both basic and plural translation. Additionally the class contain a 
method for translating a multidimensional array of message strings (plural form 
is not supported).
MD
);
CodeExampleBuilder::visualize('Sphp/I18n/Translator.php', 'text', false);

\Sphp\Manual\loadPage('Sphp.I18n.Messages');
$calendar = Apis::sami()->classLinker(Calendar::class);
\Sphp\Manual\parseDown(<<<MD
##Localized calendar related translations

The $calendar class.

MD
);
CodeExampleBuilder::visualize('Sphp/I18n/Calendar.php', 'text', false);


<?php

namespace Sphp\I18n;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$php = Apis::phpManual();
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

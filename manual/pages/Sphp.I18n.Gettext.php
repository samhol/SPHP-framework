<?php

namespace Sphp\I18n\Gettext;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$php = Apis::phpManual();
$gettextTranslator = \Sphp\Manual\api()->classLinker(Translator::class);

$gettextNs = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

\Sphp\Manual\parseDown(<<<MD
###A gettext $gettextTranslator
$gettextNs    
  
A $gettextTranslator object translates given input by using PHP's build in 
gettext extension.
        

The underlying technology used in translation is PHP's gettext extension.
 
**Links:**
  * http://www.gnu.org/software/gettext/manual/
  * http://www.gnu.org/software/gettext/manual/html_node/index.html
  * http://php.net/manual/en/book.gettext.php
  * http://php.net/manual/en/function.setlocale.php
MD
);
CodeExampleBuilder::visualize('Sphp/I18n/Gettext/Translator.php', 'text', false);

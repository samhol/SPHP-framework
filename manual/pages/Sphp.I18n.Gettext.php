<?php

namespace Sphp\I18n\Gettext;

use Sphp\Manual;

$gettextTranslator = Manual\api()->classLinker(Translator::class);
$gettextNs = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

Manual\parseDown(<<<MD
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
Manual\visualize('Sphp/I18n/Gettext/Translator.php', 'text', false);

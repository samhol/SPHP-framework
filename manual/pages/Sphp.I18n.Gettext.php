<?php

namespace Sphp\I18n\Gettext;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$php = Apis::phpManual();
$gettextTranslator = Apis::sami()->classLinker(Translator::class);

$gettextNs = Apis::sami()->namespaceBreadGrumbs(__NAMESPACE__);

\Sphp\Manual\parseDown(<<<MD
###A gettext $gettextTranslator
$gettextNs    
  
A $gettextTranslator object translates given input by using PHP's build in 
gettext extension.
MD
);
CodeExampleBuilder::visualize('Sphp/I18n/Gettext/Translator.php', 'text', false);

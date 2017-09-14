<?php

namespace Sphp\I18n\Zend;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$php = Apis::phpManual();
$translator  = Apis::sami()->classLinker(Translator::class);

$ns = Apis::sami()->namespaceBreadGrumbs(__NAMESPACE__);

\Sphp\Manual\parseDown(<<<MD
###A Zend based $translator
$ns    
  
A $translator object translates given input with Translators provided by Zend framework
MD
);
CodeExampleBuilder::visualize('Sphp/I18n/Zend/Translator.php', 'text', false);

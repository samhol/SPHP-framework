<?php

namespace Sphp\I18n\Zend;

use Sphp\Manual;

$translator = Manual\api()->classLinker(Translator::class);
$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

Manual\parseDown(<<<MD
###A Zend based $translator
$ns    
  
A $translator object translates given input with Translators provided by Zend framework
MD
);

Manual\visualize('Sphp/I18n/Zend/Translator.php', 'text', false);

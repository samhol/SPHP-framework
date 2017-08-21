<?php

namespace Sphp\Stdlib;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

$stringObjectClass = Apis::sami()->classLinker(StringObject::class);
$strLink = Apis::phpManual()->typeLink('string');

\Sphp\Manual\parseDown(<<<MD
###The $stringObjectClass class
		
The $stringObjectClass class 
is a wrapper for native $strLink of any character encoding. It converts the wrapped
$strLink to `UTF-8` and provides some operations for this $stringObjectClass object to 
deal with the issues concerning multibyte encodings in PHP. 

MD
);

CodeExampleBuilder::visualize('Sphp/Stdlib/Types/StringObject.php', 'text', false);


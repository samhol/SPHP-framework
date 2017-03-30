<?php

namespace Sphp\Stdlib;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

$stringObjectClass = $api->classLinker(StringObject::class);
$strLink = $php->typeLink('string');

echo $parsedown->text(<<<MD
###The $stringObjectClass class
		
The $stringObjectClass class 
is a wrapper for native $strLink of any character encoding. It converts the wrapped
$strLink to `UTF-8` and provides some operations for this $stringObjectClass object to 
deal with the issues concerning multibyte encodings in PHP. 

MD
);

CodeExampleBuilder::visualize('Sphp/Core/Types/StringObject.php', 'text', false);


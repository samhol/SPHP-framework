<?php

namespace Sphp\Util;

use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;

$stringObjectClass = $api->getClassLink(StringObject::class);
$strLink = $php->getTypeLink("string");

echo $parsedown->text(<<<MD
###The $stringObjectClass class
		
The $stringObjectClass class 
is a wrapper for native $strLink of any character encoding. It converts the wrapped
$strLink to `UTF-8` and provides some operations for this $stringObjectClass object to 
deal with the issues concerning multibyte encodings in PHP. 

MD
);

CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Util/StringObject.php", "php", false);


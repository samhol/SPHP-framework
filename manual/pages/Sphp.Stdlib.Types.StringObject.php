<?php

namespace Sphp\Stdlib;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleAccordionBuilder;

$stringObjectClass = \Sphp\Manual\api()->classLinker(MbString::class);
$strLink = Apis::phpManual()->typeLink('string');

\Sphp\Manual\parseDown(<<<MD
###The $stringObjectClass class
		
The $stringObjectClass class is a wrapper for a PHP $strLink with any character 
encoding. Therefore it can deal with the issues concerning multibyte encodings in PHP. 

MD
);

CodeExampleAccordionBuilder::visualize('Sphp/Stdlib/Types/StringObject.php', 'text', false);


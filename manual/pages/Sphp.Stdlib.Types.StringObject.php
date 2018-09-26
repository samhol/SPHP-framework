<?php

namespace Sphp\Stdlib;

$stringObjectClass = \Sphp\Manual\api()->classLinker(MbString::class);
$strLink = \Sphp\Manual\php()->typeLink('string');

\Sphp\Manual\md(<<<MD
###The $stringObjectClass class
		
The $stringObjectClass class is a wrapper for a PHP $strLink with any character 
encoding. Therefore it can deal with the issues concerning multibyte encodings in PHP. 

MD
);

\Sphp\Manual\visualize('Sphp/Stdlib/MbString.php', 'text', false);


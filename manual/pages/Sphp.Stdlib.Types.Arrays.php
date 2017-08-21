<?php

namespace Sphp\Stdlib;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;
$arraysClass = Apis::sami()->classLinker(Arrays::class);
$arrLink = Apis::phpManual()->typeLink('array');
\Sphp\Manual\parseDown(<<<MD
##The $arraysClass class for PHP's $arrLink manipulation

PHP's $arrLink type is optimized for several different uses; it can be treated as 
an array, list (vector), hash table (an implementation of a map), dictionary, 
collection, stack, queue, and much more. As $arrLink values can be other arrays, 
trees and multidimensional arrays are also possible.

PHP core itself has several functions for $arrLink manipulation and interaction. $arraysClass 
is just a small static utility class for some additional $arrLink related operations.
		
$arraysClass methods for testing differert $arrLink properties.
MD
);

CodeExampleBuilder::visualize('Sphp/Stdlib/Types/Arrays1.php', 'text', false);
\Sphp\Manual\parseDown(<<<MD
$arraysClass methods for manipulating array properties and creating new arrays.
MD
);
CodeExampleBuilder::visualize('Sphp/Stdlib/Types/Arrays2.php', 'text', false);
\Sphp\Manual\parseDown(<<<MD
$arraysClass class has a method for 'cloning' multidimensional PHP arrays. {$arraysClass->methodLink("copy")} 
tries to make an independent copy out of each key => value pairs it the input 
array and it uses PHP's object cloning construct for object type.
MD
);
CodeExampleBuilder::visualize('Sphp/Stdlib/Types/Arrays3.php', 'text', false);

<?php

namespace Sphp\Core\Types;

use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;

$arraysClass = $api->classLinker(Arrays::class);
$arrLink = $php->getTypeLink("array");
echo $parsedown->text(<<<MD
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

CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Core/Types/Arrays1.php", "php", false);
echo $parsedown->text(<<<MD
$arraysClass methods for manipulating array properties and creating new arrays.
MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Core/Types/Arrays2.php", "php", false);
echo $parsedown->text(<<<MD
$arraysClass class has a method for 'cloning' multidimensional PHP arrays. {$api->getClassMethodLink(Arrays::class, "copy")} 
tries to make an independent copy out of each key => value pairs it the input 
array and it uses PHP's object cloning construct for object type.
MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Core/Types/Arrays3.php", "php", false);

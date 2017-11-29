<?php

namespace Sphp\Stdlib;

use Sphp\Manual;

$arraysClass = Manual\api()->classLinker(Arrays::class);
$arrLink = Manual\php()->typeLink('array');
Manual\parseDown(<<<MD
##The $arraysClass class for PHP's $arrLink manipulation

PHP's $arrLink type can be treated as 
an array, list (vector), hash table (an implementation of a map), dictionary, 
collection, stack, queue, and much more. As values can be other arrays, 
trees and multidimensional arrays are also possible.

$arraysClass is a static utility class extending $arrLink related operations in 
PHP core and it introduces methods for:

* testing $arrLink properties.
* manipulating array properties and creating new arrays.
* 'cloning' multidimensional PHP arrays.

MD
);

Manual\visualize('Sphp/Stdlib/Types/Arrays1.php', 'text', false);

Manual\visualize('Sphp/Stdlib/Types/Arrays2.php', 'text', false);

Manual\example('Sphp/Stdlib/Types/Arrays3.php', 'text', false)
        ->setExamplePaneTitle('Cloning the content of an array')
        ->printHtml();

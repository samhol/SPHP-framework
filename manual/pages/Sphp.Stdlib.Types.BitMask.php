<?php

namespace Sphp\Stdlib;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

$bitMaskLink = $api->classLinker(BitMask::class);
$and = $bitMaskLink->methodLink("and_");
$or = $bitMaskLink->methodLink("or_");
$xor = $bitMaskLink->methodLink("xor_");
echo $parsedown->text(<<<MD
##Class $bitMaskLink

This Implements an collection of bits that grows as needed. Each component 
of the bit set has a boolean value. The bits of a $bitMaskLink are indexed by nonnegative 
integers. Individual indexed bits can be examined, set, or cleared. 
One $bitMaskLink may be used to modify the contents of another $bitMaskLink through the 
implemented logical AND, logical inclusive OR, and logical exclusive OR operations.
MD
);
CodeExampleBuilder::visualize('Sphp/Stdlib/Types/BitMask.php', "text", false);

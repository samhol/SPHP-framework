<?php

namespace Sphp\Core\Types;

use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;

$bitMaskLink = $api->getClassLink(BitMask::class);
$and = $api->getClassMethodLink(BitMask::class, "and_");
$or = $api->getClassMethodLink(BitMask::class, "or_");
$xor = $api->getClassMethodLink(BitMask::class, "xor_");
echo $parsedown->text(<<<MD
##Class $bitMaskLink

This class implements an collection of bits that grows as needed. Each component 
of the bit set has a boolean value. The bits of a $bitMaskLink are indexed by nonnegative 
integers. Individual indexed bits can be examined, set, or cleared. 
One $bitMaskLink may be used to modify the contents of another $bitMaskLink through the 
implemented logical AND, logical inclusive OR, and logical exclusive OR operations.
MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Core/Types/BitMask.php", "php", false);

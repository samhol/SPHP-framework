<?php

namespace Sphp\Core\Types;

use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;

$bitMaskLink = $api->classLinker(BitMask::class);
$and = $bitMaskLink->method("and_");
$or = $bitMaskLink->method("or_");
$xor = $bitMaskLink->method("xor_");
echo $parsedown->text(<<<MD
##Class $bitMaskLink

This class implements an collection of bits that grows as needed. Each component 
of the bit set has a boolean value. The bits of a $bitMaskLink are indexed by nonnegative 
integers. Individual indexed bits can be examined, set, or cleared. 
One $bitMaskLink may be used to modify the contents of another $bitMaskLink through the 
implemented logical AND, logical inclusive OR, and logical exclusive OR operations.
MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Core/Types/BitMask.php", "text", false);

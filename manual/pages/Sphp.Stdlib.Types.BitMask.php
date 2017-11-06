<?php

namespace Sphp\Stdlib;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$bitMask = \Sphp\Manual\api()->classLinker(BitMask::class);

\Sphp\Manual\parseDown(<<<MD
##Bit manipulation <small>by using $bitMask objects</small>

A $bitMask Implements an collection of bits that grows as needed. The bits of a $bitMask are indexed by nonnegative 
integers. Individual indexed bits can be examined, set, or cleared. Additionally One $bitMask may be used to modify the contents of another $bitMask through the 
implemented logical AND, logical inclusive OR, and logical exclusive OR operations.
MD
);
CodeExampleBuilder::visualize('Sphp/Stdlib/Types/BitMask.php', "text", false);

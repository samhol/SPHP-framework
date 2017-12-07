<?php

namespace Sphp\Stdlib\Datastructures;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleAccordionBuilder;
use Sphp\Html\Apps\Manual\Apis;

$uniquePriorityQueue = \Sphp\Manual\api()->classLinker(UniquePriorityQueue::class);
\Sphp\Manual\parseDown(<<<MD
###The $uniquePriorityQueue data structure

This Implements a set of prioritized objects mapped with corresponding data of any type.

MD
);
CodeExampleAccordionBuilder::visualize("Sphp/Stdlib/Datastructures/UniquePriorityQueue.php", "text", false);

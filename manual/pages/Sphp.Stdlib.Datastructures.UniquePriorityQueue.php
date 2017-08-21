<?php

namespace Sphp\Stdlib\Datastructures;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$uniquePriorityQueue = Apis::sami()->classLinker(UniquePriorityQueue::class);
\Sphp\Manual\parseDown(<<<MD
###The $uniquePriorityQueue data structure

This Implements a set of prioritized objects mapped with corresponding data of any type.

MD
);
CodeExampleBuilder::visualize("Sphp/Data/UniquePriorityQueue.php", "text", false);

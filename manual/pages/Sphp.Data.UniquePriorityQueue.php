<?php

namespace Sphp\Stdlib\Datastructures;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

$uniquePriorityQueue = $api->classLinker(UniquePriorityQueue::class);
echo $parsedown->text(<<<MD
###The $uniquePriorityQueue data structure

This Implements a set of prioritized objects mapped with corresponding data of any type.

MD
);
CodeExampleBuilder::visualize("Sphp/Data/UniquePriorityQueue.php", "text", false);

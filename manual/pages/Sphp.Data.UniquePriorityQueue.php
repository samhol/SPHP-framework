<?php

namespace Sphp\Data;

use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;

$uniquePriorityQueue = $api->classLinker(UniquePriorityQueue::class);
echo $parsedown->text(<<<MD
###The $uniquePriorityQueue data structure

This class implements a set of prioritized objects mapped with corresponding data of any type.

MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Data/UniquePriorityQueue.php", "text", false);

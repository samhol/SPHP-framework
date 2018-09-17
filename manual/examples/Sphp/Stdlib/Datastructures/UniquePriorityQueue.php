<?php

namespace Sphp\Stdlib\Datastructures;

$queue = new UniquePriorityQueue();
$queue
        ->enqueue("1st.Priority 10", 10)
        ->enqueue("2nd. Priority 10", 10)
        ->enqueue("Priority 1", 6)
        ->enqueue("Priority 1", 1)
        ->enqueue("Priority 10000", 10000)
        ->enqueue("Priority 3", 3);
print_r($queue);
echo implode("\n", $queue->toArray());


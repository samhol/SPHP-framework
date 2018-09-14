<?php

namespace Sphp\Stdlib\Datastructures;

$queue = new PriorityQueue();
$queue->enqueue('bar', 5);
$queue->enqueue('F', 10);
$queue->enqueue('O', 8);
$queue->enqueue('o', 10);
$queue->enqueue('-', 6);
echo implode($queue->toArray());

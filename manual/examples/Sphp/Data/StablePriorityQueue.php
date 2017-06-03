<?php

namespace Sphp\Stdlib\Datastructures;

$q = new StablePriorityQueue();
$q->insert("priority 1", 1);
$q->insert("1st priority 2", 2);
$q->insert("priority 3", 3);
$q->insert("2nd priority 2", 2);
$q->insert("priority 4", 4);
foreach ($q as $key => $value) {
  echo "$value\n";
}

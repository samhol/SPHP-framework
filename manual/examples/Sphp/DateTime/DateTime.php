<?php

namespace Sphp\DateTime;

$now = new DateTime();
var_dump($now->getHours(), $now->getMinutes());
echo "Now is " . $now->format('Y-m-d H:i:s O') . "\n";
echo "Tomarrow is " . $now->nextDay()->format('l \t\h\e jS \of F Y') . "\n";
echo "Yesterday was " . $now->previousDay()->format('l \t\h\e jS \of F Y') . "\n";
echo "First day of this month was " . $now->firstOfMonth()->format('l') . "\n";

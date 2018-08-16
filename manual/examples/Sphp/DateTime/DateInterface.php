<?php

namespace Sphp\DateTime;

$now = new DateWrapper();

echo "Today is " . $now->format('l \t\h\e jS \of F Y') . "\n";
echo "Tomarrow is " . $now->nextDay()->format('l \t\h\e jS \of F Y') . "\n";
echo "Yesterday was " . $now->previousDay()->format('l \t\h\e jS \of F Y') . "\n";
echo "First day of this month was " . $now->firstOfMonth()->format('l') . "\n";
echo "First day of this month was " . $now->firstOfMonth()->format("") . "\n";
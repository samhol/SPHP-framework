<?php

namespace Sphp\DateTime;

$now = new Date();

echo "Today is " . $now->format('l \t\h\e jS \of F Y') . "\n";
echo "Tomarrow is " . $now->nextDate()->format('l \t\h\e jS \of F Y') . "\n";
echo "Yesterday was " . $now->previousDate()->format('l \t\h\e jS \of F Y') . "\n";
echo "First day of this month was " . $now->firstOfMonth()->format('l') . "\n";
echo "First day of this month was " . $now->firstOfMonth()->format("") . "\n";
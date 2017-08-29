<?php

namespace Sphp\Stdlib;

$mask1 = new BitMask(0b10);
echo "bin: $mask1\n";
echo "bit at 0: " . $mask1->get(0) . "\n";
echo "bit at 1: " . $mask1->get(1) . "\n";
echo "OR 0b101: {$mask1->binOR(0b101)}\n";
echo "set and unset: {$mask1->set(4)->unset(0)->unset(1)->unset(2)}\n";

echo bcmul('956349569436593469563495634659834659346956349563496593465', '956349569436593469563495634659834659346956349563496593465', 0);

<?php

namespace Sphp\Stdlib;

$mask1 = new BitMask(0b101001);
echo "mask1: $mask1\n";
echo "value at index 2: " . $mask1->get(2) . "\n";
$mask1->or_(0b1100);
echo "mask1: $mask1\n";
$mask1->set(0, 0)->set(1, true)->set(4);
echo "mask1: $mask1\n";
$mask2 = new BitMask(PHP_INT_MAX);
echo "mask2: $mask2\n";
$mask2->xor_(0b1110);
echo "mask2: $mask2\n";
$mask2->or_(0b1110);
echo "mask2: $mask2\n";
$mask2->and_($mask1);
echo "mask2: $mask2\n";

echo bcmul('956349569436593469563495634659834659346956349563496593465', '956349569436593469563495634659834659346956349563496593465', 0);

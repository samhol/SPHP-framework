<?php

namespace Sphp\Core\Types;

$mask1 = new BitMask(0b100001);
echo "mask1: $mask1\n";
echo "value at index 0: " . $mask1->get(0) . "\n";
echo "value at index 2: " . $mask1->get(2) . "\n";
$mask1->or_(0b1100);
echo "mask1: $mask1\n";
$mask1->set(0, FALSE)->set(1, TRUE)->set(4);
echo "mask1: $mask1\n";
$mask2 = new BitMask(PHP_INT_MAX);
echo "mask2: $mask2\n";
$mask2->xor_(0b1110);
echo "mask2: $mask2\n";
$mask2->or_(0b1110);
echo "mask2: $mask2\n";
$mask2->and_($mask1);
echo "mask2: $mask2\n";
?>
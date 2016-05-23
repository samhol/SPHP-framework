<?php

namespace Sphp\Util;

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
/*$bitSet2 = new BitMask(43);
echo "bitSet2: $bitSet2\n";
echo "bitSet1 == bitSet2: " . var_export($bitSet1->equals($bitSet2), true) . "\n";
$bitSet3 = new BitMask("101011");
echo "bitSet3: $bitSet3\n";
echo "bitSet2->equals(bitSet3): " . var_export($bitSet2->equals($bitSet3), true) . "\n";
echo "bitSet2 == bitSet3: " . var_export(($bitSet2 == $bitSet3), true) . "\n";
$bitSet4 = clone $bitSet3;
echo "bitSet4: $bitSet4\n";
$bitSet1->clear(0b100000);
echo "bitSet1: $bitSet1\n";
echo "bitSet2->contains(bitSet1): " . var_export($bitSet2->contains($bitSet1), true) . "\n";
echo "bitSet2->contains(0b11111111): " . var_export($bitSet2->contains(0b11111111), true) . "\n";*/
?>
<?php

namespace Sphp\Stdlib;

$mask1 = new BitMask(0b10);
echo "bin: $mask1\n";
echo "bit at 0: " . $mask1->getBit(0) . "\n";
echo "bit at 1: " . $mask1->getBit(1) . "\n";
echo "OR 0b101: {$mask1->binOR(0b101)}\n";
echo "set and unset: {$mask1->setBit(4)->unsetBit(0)->unsetBit(1)->unsetBit(2)}\n";

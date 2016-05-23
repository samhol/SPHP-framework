<?php

namespace Sphp\Objects;

$addr = new Address([Address::STREET => "Rakuunatie 59 A 3"]);
echo "$addr\n";
$user = new User([Address::STREET => "Rakuunatie 59 A 3"]);
echo "$user\n";

function result($flag1, $flag2) {
	echo "$flag1 equals to $flag2:";
	var_dump($flag1->equals($flag2));
	echo "$flag1 contains $flag2:";
	var_dump($flag1->contains($flag2));
}

$flag1 = new BitMask(0b101);
echo "flag1: $flag1\n";
$flag2 = new BitMask("101");
echo "flag2: $flag2\n";

result($flag1, $flag2);

$flag1->or_(0b101000);

result($flag1, $flag2);

$flag1->or_(0b101000)->turnOff($flag2);

result($flag1, $flag2);
var_dump(intval("0b11"));
var_dump(0b11);
?>
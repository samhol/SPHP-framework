<?php

namespace Sphp\Net;

use Sphp\Core\Types\Strings;

for ($i = 1; $i <= 4; ++$i) {
	$password[$i] = Strings::random(6);
	$hash[$i] = Passwords::hash($password[$i]);
	echo "password: '$password[$i]' hash '$hash[$i]'\n";
}
foreach ($password as $index => $pw) {
	foreach ($hash as $h) {
		echo "password: '$pw' hashed is '$h'" . Passwords::checkPassword($h, $pw) . "\n";
	}
}
?>
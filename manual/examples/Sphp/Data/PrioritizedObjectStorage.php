<?php

namespace Sphp\Data;

use Sphp\Util\StringObject as StringObject;

$storage = new PrioritizedObjectStorage();
$storage
		->insert(new StringObject("Priority 10"), "1st.", 10)
		->insert(new StringObject("Priority 10"), "2nd.", 10)
		->insert(new StringObject("Priority -1"), "3rd.", -1)
		->insert(new StringObject("Priority 10000"), "4th.", 10000)
		->insert(new StringObject("Priority a"), "5th.", "a");
foreach ($storage as $object) {
	echo "$object inserted {$storage->getdData($object)}\n";
}
<?php
namespace Sphp\Data;

use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion;
$storage = $api->classLinker(PrioritizedObjectStorage::class);
echo $parsedown->text(
		<<<MD
###The $storage class

This class implements a set of prioritized objects mapped with corresponding data of any type.

MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Data/PrioritizedObjectStorage.php", "php", false);

?>
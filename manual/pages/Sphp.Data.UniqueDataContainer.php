<?php

namespace Sphp\Data;

use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;

$storage = $api->classLinker(UniqueDataContainer::class);
$lockablePropertyStorage = $api->classLinker(LockablePropertyStorage::class);
echo $parsedown->text(<<<MD
##The $storage and $lockablePropertyStorage classes

These class implement a container of unique data. 

MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Data/UniqueDataContainer.php", "php", false);
echo $parsedown->text(<<<MD
In additioan the $lockablePropertyStorage enables a possibility to lock properties so that they are immutable.
MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Data/UniqueDataContainer.php", "php", false);
?>
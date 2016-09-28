<?php
namespace Sphp\Data;

use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion;
$storage = $api->classLinker(PropertyStorage::class);
$lockablePropertyStorage = $api->classLinker(LockablePropertyStorage::class);
echo $parsedown->text(<<<MD
##The $storage and $lockablePropertyStorage classes

These class implement a set of property names mapped with corresponding data of any type. 

MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Data/PropertyStorage.php", "php", false);
echo $parsedown->text(<<<MD
In additioan the $lockablePropertyStorage enables a possibility to lock properties so that they are immutable.
MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Data/LockablePropertyStorage.php", "php", false);

?>
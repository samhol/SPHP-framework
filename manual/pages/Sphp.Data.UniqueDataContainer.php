<?php

namespace Sphp\Stdlib\Datastructures;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

$storage = $api->classLinker(UniqueDataContainer::class);
$lockablePropertyStorage = $api->classLinker(LockablePropertyStorage::class);
echo $parsedown->text(<<<MD
##The $storage and $lockablePropertyStorage classes

These class implement a container of unique data. 

MD
);
CodeExampleBuilder::visualize("Sphp/Data/UniqueDataContainer.php", "php", false);
echo $parsedown->text(<<<MD
In additioan the $lockablePropertyStorage enables a possibility to lock properties so that they are immutable.
MD
);
CodeExampleBuilder::visualize("Sphp/Data/UniqueDataContainer.php", "php", false);

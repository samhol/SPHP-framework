<?php

namespace Sphp\Stdlib\Datastructures;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

$collection = $api->classLinker(Collection::class);
$collectionInterface = $api->classLinker(CollectionInterface::class);
echo $parsedown->text(<<<MD
##The $collection 

This class provides an implementation of $collectionInterface.

MD
);
CodeExampleBuilder::visualize("Sphp/Data/SphpArrayObject.php", "text", false);
CodeExampleBuilder::visualize("Sphp/Data/Collection.php", "text", false);

